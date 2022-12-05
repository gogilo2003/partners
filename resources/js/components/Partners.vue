<template>
    <div class="buttons">
        <button class="btn btn-primary btn-round btn-fab" @click="addPartner"><i class="material-icons">add</i></button>
    </div>
    <div class="partners-list">
        <Partner v-on:edit="editPartner($event)" v-on:published="publishedPartner" v-for="item in partners"
            :partner="item" />
    </div>
    <Dialog :show="show" @closed="closed" header="Add/Edit Partner">
        <template #body>
            <div class="form-grid row">
                <div class="col-md-12 form-group is-invalid">
                    <label for="nameInput">Partner's Name</label>
                    <input v-model="partner.name" type="text" class="form-control" id="nameInput">
                </div>
                <div class="col-md-4 form-group">
                    <label for="phoneInput">Partner's Phone</label>
                    <input v-model="partner.phone" type="text" class="form-control" id="phoneInput">
                </div>
                <div class="col-md-4 form-group">
                    <label for="emailInput">Partner's Email</label>
                    <input v-model="partner.email" type="text" class="form-control" id="emailInput">
                </div>
                <div class="col-md-4 form-group">
                    <label for="websiteInput">Partner's Website</label>
                    <input v-model="partner.website" type="text" class="form-control" id="websiteInput">
                </div>
                <div class="col-md-12">
                    <Socialmedia v-model="partner.socialmedia" label="Social media" />
                </div>
            </div>
        </template>
        <template #footer>
            <button @click="close" class="btn btn-outline-primary btn-round"><i class="material-icons">close</i>
                Close</button>
            <button @click="savePartner" class="btn btn-primary btn-round"><i class="material-icons">save</i>
                Save</button>
        </template>
    </Dialog>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Partner from './Partner'
import Dialog from './Dialog'
import Socialmedia from './Socialmedia'

const title = ref('')
const partners = ref([])
const partner = ref({})

const show = ref(false)
const edit = ref(false)

onMounted(() => {
    title.value = "Partners listing"

    axios.get(`/admin/api/v1/partners`).then(response => {
        partners.value = response.data.data
    }).catch(error => {
        console.log(error.response.data);
    })
})

const close = () => {
    show.value = false
}

const closed = (value) => {
    show.value = value
}

const editPartner = (value) => {
    partner.value = value
    show.value = true
    edit.value = true
}

const addPartner = () => {
    partner.value = {
        name: null,
        logo: null,
        phone: null,
        email: null,
        website: null,
        socialmedia: []
    }
    edit.value = false
    show.value = true
}

const savePartner = () => {
    if (edit.value) {
        axios.patch(`/admin/api/v1/partners`, partner.value).then(response => {
            $.notify({
                "message": ""
            })
            console.log(response.data)
        }).catch(error => {
            console.log(error.response.data);
        })
    } else {
        axios.post(`/admin/api/v1/partners`, partner.value).then(response => {
            console.log(response.data)
        }).catch(error => {
            console.log(error.response.data);
        })
    }

}

const publishedPartner = data => {
    let index = partners.value.findIndex(item => {
        return item.id === data.id
    })

    partners.value[index].published = data.published
}
</script>

<style lang="scss">
.partners-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 2rem;
}
</style>