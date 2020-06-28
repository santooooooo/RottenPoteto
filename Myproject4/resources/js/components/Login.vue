<template>
<div name="nav">
<a v-if="!isUser" href="login/oauth">新規登録orログイン</a>
<a v-if="isUser" href="/logout">ログアウト</a>
<p v-if="isUser" @click="signOutForm">退会</p>
<form v-if="doSignOut" action="/signout" method="post">
	<input type="hidden" name="gmail" :value="userInfo.gmail">
	<input type="submit" value="退会を実行">
</form>
<router-link v-if="isUser" :to="{ path: '/user-profile/' + userInfo.gmail }">プロフィールの変更
</router-link>
</div>
</template>

<script>
    export default {
	    props:
	    {
		    userInfo: {
			    type: Object,
			    required: false,
		    }
	    },
	    data: function() {
		    return {
			    signOut: false,
		    }
	    },
	    computed: 
	    {
		    isUser: function() {
			    if(this.userInfo.length != 0)
			    {
				    return true
			    }
			    return false
		    },
		    doSignOut: function() {
			    if(this.signOut)
			    {
				    return true
			    }
			    return false
		    }
	    },
	    methods: {
		    signOutForm: function() {
			    const check = window.confirm("本当に退会しますか？")
			    if(check)
			    {
				    return this.signOut = true
			    }
			    return ;
		    }
	    },
    }
</script>
