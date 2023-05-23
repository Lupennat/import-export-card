<template>
    <Card class="flex flex-col justify-center p-3">
        <div class="px-3 py-3">
            <h1 class="text-xl font-light">Download sample import</h1>
            <p class="text-80">{{ this.card.helpText }}</p>
        </div>
        <DefaultButton type="submit" @click="download" align="center" class="ml-auto">Download</DefaultButton>
    </Card>
</template>

<script>
    export default {
        props: ['card'],

        methods: {
            download() {
                let link = document.createElement('a');
                link.href = this.card.filename;
                link.download = 'download';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }
        }
    };
</script>
