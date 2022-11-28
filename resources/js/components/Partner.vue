<template>
    <div class="partner">
        <img :src="partner.logo" :alt="partner.name">
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
            <div class="buttons">
                <button @click="edit" class="btn btn-primary btn-fab btn-round"><i
                        class="material-icons">edit</i></button>
            </div>
        </div>
    </div>
</template>

<script setup>

const props = defineProps(['partner'])
const emit = defineEmits(['edit'])

const edit = () => {
    emit("edit", props.partner)
}
</script>

<style lang="scss">
.partner {
    display: flex;
    margin: 1rem 0;
    box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.35);
    border-radius: 1.5rem;
    padding: 1rem;

    img {
        //border: 1px solid #555;
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
</style>