<template>
    <table class="table table-striped">
        <caption style="caption-side:top">{{ label }}</caption>
        <tbody>
            <tr v-for="(mItem, index) in items" :key="index">
                <td>{{ index + 1 }}</td>
                <td>{{ mItem.name }}</td>
                <td>{{ mItem.url }}</td>
                <td>
                    <button @click="editItem(mItem)" class="btn btn-fab btn-outline-primary btn-round"><i
                            class="material-icons">edit</i></button>
                </td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>
                    <button @click="addItem" class="btn btn-outline-primary btn-fab btn-round"><i
                            class="material-icons">add</i></button>
                </td>
            </tr>
        </tfoot>
    </table>
    <Dialog :show="show" header="Add/Edit Socialmedia Item" :size="6" @closed="show = false">
        <template #body>
            <div class="form-group">
                <label for="inputName">Name</label>
                <input v-model="item.name" type="text" class="form-control" id="inputName">
            </div>
            <div class="form-group">
                <label for="inputUrl">Url</label>
                <input v-model="item.url" type="text" class="form-control" id="inputUrl">
            </div>
        </template>
        <template #footer>
            <button class="btn btn-primary btn-round" @click="save"><i class="material-icons">done_all</i>Done</button>
        </template>
    </Dialog>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue'
import Dialog from './Dialog.vue'

const props = defineProps(["label", "modelValue"]);
const emit = defineEmits(["update:modelValue"]);

const item = ref({ name: null, url: null })
const items = ref([])
const show = ref(false)
const edit = ref(false)

onMounted(() => {
    items.value = props.modelValue
})

watch(() => props.modelValue, newValue => {
    items.value = props.newValue
})

const addItem = () => {
    show.value = true
    edit.value = false
    item.value = { name: null, url: null }
}

const editItem = (value) => {
    show.value = true
    edit.value = true
    item.value = value
}

const save = () => {
    if (!edit.value) {
        items.value.unshift(item.value)
    }

    emit('update:modelValue', items.value)
    show.value = false
    edit.value = false
}
</script>