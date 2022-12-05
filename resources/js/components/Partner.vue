<script setup>
import { ref, onMounted, watchEffect } from 'vue';
import DialogVue from './Dialog.vue';
import 'cropperjs/dist/cropper.css';
import Cropper from 'cropperjs';

const props = defineProps(['partner'])
const emit = defineEmits(['edit', 'published'])

const cropper = ref(null)
const browse = ref(null)

const showLogoDialog = ref(false)

const logo = ref(null)
const imgSrc = ref(null)
const output = ref(null)
const partnerLogo = ref(null)

const changeLogo = (event) => {
    console.log('changeLogo1: ', imgSrc.value)
    imgSrc.value = URL.createObjectURL(event.target.files[0]);
    console.log('changeLogo2: ', imgSrc.value)
    cropper.value.replace(imgSrc.value)
}

watchEffect(() => {

    if (logo.value) {
        cropper.value = new Cropper(logo.value, {
            aspectRatio: 1 / 1,
            crop(event) {
                // console.log(event.detail);
            },
        })
    }

})

const showBrowse = () => {
    browse.value.click()
}

const showLogo = () => {
    showLogoDialog.value = true
    imgSrc.value = props.partner.logo
}

const uploadLogo = () => {
    cropper.value.getCroppedCanvas().toBlob(blob => {
        var data = new FormData();
        data.append('_method', "PUT");
        data.append('id', props.partner.id);
        data.append('logo', blob);

        var config = {
            onUploadProgress: function (progressEvent) {
                var percentCompleted = Math.round((progressEvent.loaded * 100) / progressEvent.total);
                output.value.innerHTML = `${percentCompleted} %`
            }
        };

        axios.post('/admin/api/v1/partners/logo', data, config)
            .then(function (res) {
                output.value.className = 'container';
                partnerLogo.value.src = res.data.logo;
                showLogoDialog.value = false;
            })
            .catch(function (err) {
                output.value.className = 'container text-danger';
                output.value.innerHTML = err.message;
            });
    });

};

const publishPartner = (id) => {
    axios.patch('/admin/api/v1/partners/publish', { id })
        .then(function (res) {
            emit('published', { id: res.data.id, published: res.data.published })
            $.notify({
                message: res.data.message
            })
        })
        .catch(function (err) {
            console.log(err);
        });
}
const logoDialogClosed = () => {
    showLogoDialog.value = false
}
</script>

<template>
    <div class="partner">
        <img ref="partnerLogo" :src="partner.logo" @click="showLogo">
        <div class="details">
            <div class="field">
                <span class="label">Name:</span> <span v-text="partner.name"></span>
            </div>
            <div class="field">
                <span class="label">Phone:</span> <span v-text="partner.phone"></span>
            </div>
            <div class="field">
                <span class="label">Email:</span> <span v-text="partner.email"></span>
            </div>
            <div class="field">
                <span class="label">Website:</span> <span v-text="partner.website"></span>
            </div>
            <div class="field socialmedia">
                <a v-for="link in partner.socialmedia" :href="link.url" :title="link.name">
                    <i :class="`fab fa-${link.name}`"></i>
                </a>
            </div>
            <hr>
            <div class="buttons">
                <button @click="$emit('edit', partner)" class="btn btn-primary btn-fab btn-round btn-sm"><i
                        class="material-icons">edit</i></button>
                <button @click="publishPartner(partner.id)" class="btn btn-primary btn-fab btn-round btn-sm"><i
                        class="material-icons" v-text="partner.published ? 'download' : 'upload'"></i></button>
            </div>
        </div>
    </div>
    <DialogVue :show="showLogoDialog" v-on:closed="logoDialogClosed" header="Upload logo" :size="4">
        <template #body>
            <img ref="logo" :src="imgSrc" id="logo" />
        </template>
        <template #footer>
            <div style="clear:both; display:block" ref="output" id="output" class="container"></div>
            <input ref="browse" type="file" id="logoInput" @change="changeLogo" accept="image/*" style="display:none">
            <button @click="showBrowse" class="btn btn-primary btn-round">Browse</button>
            <button @click="uploadLogo" class="btn btn-primary btn-round">Upload</button>
        </template>
    </DialogVue>
</template>

<style lang="scss">
.partner {
    display: flex;
    margin: 1rem 0;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.35);
    border-radius: 1.5rem;
    padding: 1rem;

    img {
        margin: 0.5rem;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.75);
        border-radius: 0.5rem;
        width: 180px;
        height: 180px;
    }

    .details {
        padding: 1rem;
        justify-self: start;
        box-shadow: 0px 0px 4px rgba(0, 0, 0, 0.35);
        margin: 0.5rem;
        border-radius: 0.5rem;
        flex-grow: 1;

        .field {
            &.socialmedia {
                margin-top: 1rem;

                a {
                    display: inline-block;
                    box-shadow: 0 0 5px rgba(0, 0, 0, 0.35);
                    height: 32px;
                    width: 32px;
                    margin: 0 0.25rem;
                    font-size: 22px;
                    padding: 5px;
                    border-radius: 50%;
                }
            }

            .label {
                font-weight: 600;
                text-transform: uppercase;
                margin-right: 0.5rem;
            }

            .value {
                font-weight: 300;
            }
        }

        .buttons {
            margin-top: 1rem;
        }
    }
}

#logo {
    width: 100%;
}
</style>