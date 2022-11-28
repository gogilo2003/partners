<template>
    <div class="form-wrap container-fluid" v-if="show">
        <div class="row w-100">
            <div :class="`offset-md-${(12 - size) / 2} col-md-${size}`">
                <div class="card w-100">
                    <div class="card-header card-header-primary">
                        <slot name="header">{{ header }}</slot>
                        <button @click="$emit('closed', false)"
                            class="btn btn-outline-danger btn-fab btn-sm btn-close"><i
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
import { watch } from 'vue'
const props = defineProps({
    show: Boolean,
    header: String,
    size: {
        type: Number,
        default: 8
    }
})
const emit = defineEmits(['closed'])


watch(() => props.show, (old, new) => {
    console.log(old)
})
</script>