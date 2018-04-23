<template>
    <router-view></router-view>
</template>

<script>
export default {
	mounted() {
		if (!this.$auth.token()) {
			$('body').addClass('login-page');
		} else {
			$('body').removeClass('login-page')
		}
	}
}
</script>