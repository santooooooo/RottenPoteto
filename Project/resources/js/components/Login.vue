<template>
	<div>
		<a v-if="!isUser" href="login/oauth"><img src="storage/home/GoogleIcon" class="gIcon">
			新規登録orログイン</a>
		<a v-if="isUser" href="/logout">ログアウト</a>
		<router-link v-if="isUser" :to="{ path: '/user-profile/' + userInfo.gmail }">プロフィールの変更
		</router-link>

		<p v-if="CancelButton" @click="CancelForm">退会</p>

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

@media screen and (max-width:480px) {
	a {
		margin: 0 0 20px 5px;
	}

	p {
		margin: 0 0 20px 5px;
	}

	input {
		margin: 3px 0 0 0;
	}
	}
</style>

<script>
    export default {
	    props:
	    {
		    userInfo: {
			    type: Object,
			    required: false,
		    },
		    csrfToken: {
			    type: String,
			    required: false,
		    }
	    },
	    data: function() {
		    return {
			    cancel: false,
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
		    doCancel: function() {
			    if(this.cancel)
			    {
				    return true
			    }
			    return false
		    },
		    CancelButton: function() {
			    if(this.userInfo.length != 0 && !this.cancel)
			    {
				    return true
			    }
			    return false
		    }
	    },
	    methods: {
		    CancelForm: function() {
			    const check = window.confirm("本当に退会しますか？")
			    if(check)
			    {
				    axios({
					    method: 'post',
					    url: '/cancel',
					    data: {
						    'gmail': this.userInfo.gmail
					    },
					    headers: {
						    'X-CSRF-TOKEN': this.csrfToken
					    }
				    }).then(function(response) {
					    if(response.data) {
						    alert("アカウントを削除しました。")
						    window.location = '/'
						    return
					    }
					    return
				    })
			    }
			    return ;
		    }
	    },
    }
</script>
