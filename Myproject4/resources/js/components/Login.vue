<template>
<div name="nav">
<a href="login/oauth">login</a>
<p>{{userInfo.name}}</p>
</div>
</template>

<script>
    export default {
	    props:
	    {
		    userInfo: {
			    type: Object
		    }
	    },
    }
</script>
