<template>
    <div class="form-wrap container-fluid" v-if="open">
        <div class="row w-100">
            <div class="offset-sm-0 col-sm-12" :class="`offset-md-${(12 - size) / 2} col-md-${size}`">
                <div class="card w-100">
                    <div class="card-header card-header-primary">
                        <slot name="header">{{ header }}</slot>
                        <button @click="close" class="btn btn-outline-danger btn-fab btn-sm btn-close"><i
                                class="material-icons">close</i></button>
                    </div>
                    <div class="card-body">
                        <slot name="body"></slot>
                    </div>
                    <div class="card-footer">
                        <slot name="footer"></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { watch, ref, onMounted } from 'vue'
const props = defineProps({
    show: Boolean,
    header: String,
    size: {
        type: Number,
        default: 8
    }
})
const emit = defineEmits(['closed'])
const open = ref(false)

onMounted(() => {
    open.value = props.show
})

watch(() => props.show, (newValue) => {
    open.value = props.show
})
function close() {
    open.value = false
    emit('closed', false)
}
</script>

<style lang="scss">
.form-wrap {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba($color: #000000, $alpha: 0.35);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
}

.btn-close {
    float: right;
    border-radius: 50% !important;
}

.card {
    max-height: calc(100vh - 2rem);
    margin-top: 3rem;

    .card-body {
        overflow-y: auto;
    }
}
</style>