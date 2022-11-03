<template>
    <span class="" >

        
        <EditIcon  v-if="icon == 'edit'"></EditIcon>
        <SlashIcon  v-else-if="icon == 'slash'"></SlashIcon>
        <ShoppingCartIcon   v-else-if="icon == 'shopping-cart'" style="margin-left:-1.5px"></ShoppingCartIcon>
        <DownloadIcon v-else-if="icon == 'download'"></DownloadIcon>
        <PrinterIcon v-else-if="icon == 'print'"></PrinterIcon>
        <CopyIcon v-else-if="icon == 'copy'"></CopyIcon>

        <RefreshCwIcon v-else-if="icon == 'sync'"></RefreshCwIcon>
        <MailIcon v-else-if="icon == 'mail'"></MailIcon>
        <SendIcon v-else-if="icon == 'send'"></SendIcon>
        <LayersIcon v-else-if="icon == 'layers'"></LayersIcon>
        <RepeatIcon v-else-if="icon == 'repeat'"></RepeatIcon>
        <Trash2Icon v-else-if="icon == 'trash'"></Trash2Icon>

        




        
    </span>
</template>

<script>
export default {
    props: ["icon"],
};
</script>

<style></style>
