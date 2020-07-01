<template>
	<div>
		<a v-if="!isUser" href="login/oauth"><img src="storage/home/GoogleIcon" class="gIcon">
			新規登録orログイン</a>
		<a v-if="isUser" href="/logout">ログアウト</a>
		<router-link v-if="isUser" :to="{ path: '/user-profile/' + userInfo.gmail }">プロフィールの変更
		</router-link>

		<p v-if="signOutButton" @click="signOutForm">退会</p>
		<form v-if="doSignOut" action="/signout" method="post">
			<input type="hidden" name="gmail" :value="userInfo.gmail">
			<input type="submit" value="退会を実行">
		</form>

	</div>
</template>

<style scoped>
div {
	display: flex;
	justify-content: space-between;
	margin: 30px 2% 0 0;
}

a {
	margin: 0 0 0 5px;
	padding: 5px 0;
	border: solid 3px cyan;
	border-radius: 10px;
	color: cyan;
}
a:hover {
	color: black;
	background-color: cyan;
}

p {
	margin: 0 0 0 5px;
	padding: 5px 0;
	border: solid 3px red;
	border-radius: 10px;
	color: red;
}
p:hover {
	color: black;
	background-color: red;
}

input {
	margin: 0 5px 0 0;
	border: solid 3px red;
	border-radius: 10px;
	color: red;
	background-color: black;
}
input:hover {
	color: black;
	background-color: red;
}

.gIcon {
	margin: 1px;
	width: 10%;
}

</style>

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
		    },
		    signOutButton: function() {
			    if(this.userInfo.length != 0 && !this.signOut)
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
