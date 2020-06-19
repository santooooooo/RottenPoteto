<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>
                    <div class="card-body" v-for="contribute in contributes">
                        Jamboo, I'm an example component.
												{{contribute}}
                    </div>
                </div>
            </div>
        </div>
    <p>{{userInfo}}</p>
    </div>
</template>

<script>
    export default {
    data: function()
    {
	    return {
		    contributes: [],
	    }
	  },
	  props:
	  {
		    userInfo: {
			    type: Object,
			    required: false,
		    }
	  },
		mounted: function()
		{
			axios.get('/top').then(response => this.contributes = response.data)
		},
   }
</script>
