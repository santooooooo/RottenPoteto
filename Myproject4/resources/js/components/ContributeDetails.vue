<template>
	<div>
		{{$route.params.contributeId}}
		<p>{{detailInfo}}</p>
	</div>
</template>

<script>
export default {
	data: function()
	{
		return {
			detailInfo: [],
		}
	},
	mounted: function()
		{
			axios.get('/review-page?contribute_id=' + this.$route.params.contributeId)
				.then(response => this.detailInfo = response.data);
		},
}
</script>
