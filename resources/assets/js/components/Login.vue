<template>
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>Julians</b> Hair Studio</a>
        </div>
        <div class="login-box-body">
            <p class="login-box-msg">&nbsp;</p>
            <form autocomplete="off" @submit.prevent="login" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name="username" id="username" v-model="username">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" v-model="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block btn-flat btn-block">Sign In</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            username: null,
            password: null,
            error: false
        }
    },
    methods: {
        login() {
            var app = this;
            this.$auth.login({
                data: {
                    username: app.username,
                    password: app.password
                }
            });
        }
    }
}
</script>