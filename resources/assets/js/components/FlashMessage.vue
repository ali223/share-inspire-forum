<template>
	<transition name="fade">
		<div :class="'alert alert-' + this.messageType + ' alert-flash'" role="alert" v-show="show">
			<strong>{{ messageBody }}</strong>
		</div>
	</transition>
</template>

<script>
    export default {
        props:['message', 'type'],

        data() {
            return {
                messageBody: '',
                show: false,
                messageType: ''
            }
        },
        created() {
            if (this.message && this.type) {
                this.flash(this.message, this.type);
            }

            window.events.$on('flash', (message, type) => this.flash(message, type));
        
        },
        methods: {
            flash(message, type) {
                this.messageBody = message;
                this.messageType = type;
                this.show = true;

                this.hide();
            },

            hide() {
                setTimeout( () => {
                    this.show = false;
                } ,4000)                
            }

        }
    }
</script>

<style>
.alert-flash {
    position: fixed;
    right: 25px;
    top: 25px;    
}
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s
}
.fade-enter, .fade-leave-to /* .fade-leave-active in <2.1.8 */ {
  opacity: 0
}
</style>
