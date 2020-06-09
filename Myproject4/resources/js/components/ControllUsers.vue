<template>
	
</template>

<script>
    export default {
	    data()
	    {
		    return {
			    usersInfo: []
		    }
	    },
	    mounted() {
		    let encodeInfo
	      axios.get('/').then(response => encodeInfo = response.data)
		    this.contributes = atob(encodeInfo)
        }
    }
</script>
