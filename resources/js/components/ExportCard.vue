<template>
    <Card class="flex flex-col justify-center p-3">
        <div class="px-3 py-3">
            <h1 class="text-xl font-light">{{ this.card.resourceLabel }} exporter</h1>
        </div>
        <DefaultButton type="submit" @click="submitExport" align="center" class="ml-auto">Export</DefaultButton>
    </Card>
</template>

<script>
    export default {
        props: ['card'],

        methods: {
            submitExport() {
                window.open('/nova-vendor/import-export-card/download/' + this.card.resource);
            }
        }
    };
</script>
