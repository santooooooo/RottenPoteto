<template>
	<div>
		<p>映画一覧</p>

		<div>
			<p>ジャンル別</p>
			<div v-for="category in categories">
				<input type="radio" :value="category" v-model="genre">{{category}}
			</div>
		</div>

		<div>
			<div v-for="info in contributesInfo">
			{{info}}
			</div>
		</div>

	</div>
</template>

<script>
const categories = ['アニメ','アクション','アドベンチャー','SF','コメディ','サスペンス','青春',
	'戦争','ドキュメンタリー','ドラマ','ファンタジー','ホラー','ミュージカル・音楽','恋愛', '指定なし'];
    export default {
    data: function()
    {
	    return {
		    genre: null,
		    categories: categories,
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
	  computed: {
		  contributesInfo: function()
		  {
			  if(this.genre != '指定なし' && this.genre != null)
			  {
				  let results = [];

				  for(let i = 0; i < this.contributes.length; i++)
				  {
					  if(this.contributes[i].genre == this.genre)
					  {
						  results[i] = this.contributes[i];
					  }
				  }

				  return results;
			  }
			  return this.contributes;
		  }
	  },
	  methods: {
		  inputGenre: function()
		  {
		  }
	  },
   }
</script>
