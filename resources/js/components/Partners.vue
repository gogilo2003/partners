<template>
    <div class="partners-list">
        <Partner v-on:edit="editPartner($event)" v-for="partner in partners" :partner="partner" />
    </div>
    <Dialog :show="show" @closed="closed" header="Add/Edit Partner">
        <template #body>
            <button class="btn btn-primary" @click="picShow = true">Picture</button>
        </template>
        <template #footer>
            <button @click="save" class="btn btn-primary btn-round"><i class="material-icons">save</i>
                Save</button>
            <button @click="close" class="btn btn-outline-primary btn-round"><i class="material-icons">close</i>
                Close</button>
        </template>
    </Dialog>
    <Dialog :show="picShow" header="Upload Picture" :size="4">
        <template #body>
            Picture Cropping and upload
        </template>
    </Dialog>
</template>

<script setup>
import { ref, onMounted } from 'vue'
import Partner from './Partner'
import Dialog from './Dialog'

const title = ref('')
const partners = ref([])
const partner = ref({})

const show = ref(false)
const edit = ref(false)

const picShow = ref(false)

onMounted(() => {
    title.value = "Partners listing"

    axios.get(`/api/v1/partners`).then(response => {
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
    console.log(value);
}
</script>

<style lang="scss">
.partners-list {
    display: grid;
    grid-template-columns: 1fr 1fr;
    column-gap: 2rem;
}

.form-wrap {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba($color: #000000, $alpha: 0.35);
    z-index: 99;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn-close {
    float: right;
    border-radius: 50% !important;
}
</style>