<template>
    <Card class="flex flex-col justify-center">
        <div class="px-3 py-3">
            <h1 class="text-xl font-light">{{ __('Import') }} {{ this.card.resourceLabel }}</h1>
            <form @submit.prevent="processImport" ref="form">
                <input
                    ref="fileField"
                    type="file"
                    :id="inputName"
                    :name="inputName"
                    class="hidden"
                    @change="fileChange"
                />
                <div class="space-y-4">
                    <label class="block cursor-pointer p-4">
                        <div class="flex items-center space-x-4 pointer-events-none">
                            <p class="text-center pointer-events-none">
                                <DefaultButton type="button" align="center" @click.stop="clickImport"
                                    >Choose File</DefaultButton
                                >
                            </p>
                            <p
                                class="pointer-events-none text-center text-sm text-gray-500 dark:text-gray-400 font-semibold"
                            >
                                {{ currentLabel }}
                            </p>
                        </div>
                    </label>
                </div>

                <div class="flex">
                    <div v-if="errors">
                        <p class="help-text mb-1 help-text-error" v-for="error in errors">{{ error[0] }}</p>
                    </div>
                    <DefaultButton :disabled="working" type="submit" class="ml-auto">
                        <loader v-if="working" width="30"></loader>
                        <span v-else>{{ __('Import') }}</span>
                    </DefaultButton>
                </div>
            </form>
        </div>
    </Card>
</template>

<script>
    export default {
        props: ['card'],

        data() {
            return {
                fileName: '',
                file: null,
                label: this.__('no file selected'),
                working: false,
                errors: null
            };
        },

        methods: {
            clickImport() {
                this.$refs.fileField.click();
            },
            fileChange(event) {
                let path = event.target.value;
                let fileName = path.match(/[^\\/]*$/)[0];
                this.fileName = fileName;
                this.file = this.$refs.fileField.files[0];
                this.errors = null;
            },
            processImport() {
                if (!this.file) {
                    return;
                }
                this.working = true;
                let formData = new FormData();
                formData.append('file', this.file);
                Nova.request()
                    .post('/nova-vendor/import-export-card/endpoint/' + this.card.resource, formData)
                    .then(({ data }) => {
                        Nova.success(data.message);
                        this.$parent.$parent.$parent.$parent.getResources();
                        this.errors = null;
                    })
                    .catch(({ response }) => {
                        if (response.data.danger) {
                            Nova.error(response.data.danger);
                            this.errors = null;
                        } else {
                            this.errors = response.data.errors;
                        }
                    })
                    .finally(() => {
                        this.working = false;
                        this.file = null;
                        this.fileName = '';
                        this.$refs.form.reset();
                    });
            }
        },
        computed: {
            /**
             * The current label of the file field
             */
            currentLabel() {
                return this.fileName || this.label;
            },

            firstError() {
                return this.errors ? this.errors[Object.keys(this.errors)[0]][0] : null;
            },

            inputName() {
                return 'file-import-input-' + this.card.resource;
            }
        }
    };
</script>
