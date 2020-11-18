<template>
    <div 
        class="font-bold text-white px-4 py-3 rounded relative" 
        role="alert"
        :class="typeClass"
    >
        <strong class="text-sm">{{ title }}</strong>
        <span class="block mt-1 text-xs">{{ message }}</span>
    </div>
</template>
<script>
export default {
    props: ['type', 'title', 'message'],
    methods: {
        switchClassByType() {
            switch (this.type) {
                case 'success':
                    return 'bg-green-500';
                    break;
                case 'warning':
                    return 'bg-yellow-500';
                    break;
                case 'danger':
                    return 'bg-red-500';
                    break;
                default:
                    return 'bg-blue-500';
                    break;
            }
        },
    },

    data() {
        return {
            typeClass: this.switchClassByType()
        }
    },
}
</script>