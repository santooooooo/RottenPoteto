<template>
<div name="nav">
<a v-if="!isUser" href="login/oauth">新規登録orログイン</a>
<a v-if="isUser" href="/logout">ログアウト</a>
<p v-if="isUser" @click="signOutForm">退会</p>
<form v-if="doSignOut" action="/signout" method="post">
	<input type="hidden" name="gmail" :value="userInfo.gmail">
	<input type="submit" value="退会を実行">
</form>
<form v-if="isUser" action="/update" method="post" enctype="multipart/form-data">
	<input type="hidden" name="gmail" :value="userInfo.gmail">
	<input type="text" name="name" :value="userInfo.name">
	<textarea name="profile" rows="6" cols="30" :value="userInfo.profile"></textarea>
	<input type="file" name="icon">
	<input type="text" name="best" :value="userInfo.best">
	<input type="submit" value="アカウント情報更新">
</form>
<p>{{userInfo.name}}</p>
</div>
</template>

<script>
    export default {
	    props:
	    {
		    userInfo: {
			    type: Object,
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
			    return this.signOut = true
		    }
	    },
    }
</script>
