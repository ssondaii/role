<template>
	<div class="user-page">
		<!-- <table>
			<tr><td><a href="/logout">Play Game</a></td></tr>
			<tr><td><a href="/logout">Profile</a></td></tr>
			<tr><td><a href="/logout">Log Out</a></td></tr>
		</table> -->
      <table class="table-user-page">
      	<tr>
      		<td>
      			<img v-bind:src="currentUser.img" alt="avatar" />
      		</td>
      		<td>
      			<div><a class="user-link" href="/logout">Play Game</a></div>
		    	<br>
		    	<div><a class="user-link" href='/User_detailUser'>Profile</a></div>
		    	<br>
		    	<div><a class="user-link"  href="/logout">Log Out</a></div>
      		</td>
      	</tr>
      	<tr>
      		<td colspan="2" style="border-bottom: 1px solid #636b6f;">
      			<div>- HELLO {{currentUser.name}} -</div>
      		</td>
      	</tr>
      </table>
   </div>
</template>
<script>
	export default{
		data(){
			return{
				currentUser: {
					
				}
			}
		},
		created(){
			this.getCurrentUser()
		},
		methods:{
			 getCurrentUser() {
	    		axios.get('/getCurrentUser')
  				.then(response => {
  					this.currentUser = response.data
  				})
  				.catch(error => {
  					console.log(error)
  				})
	    	}
		}
	};
</script>
<style>
	/* html, body {
       background-color: #fff;
       color: #636b6f;
       font-family: 'Arial', sans-serif;
       font-weight: 100;
       text-align: center;
       margin:  100px;
       margin-top:  80px;
       font-size: 20px;
   } */
   .table-user-page{
   		margin-top: 100px;
   }
   .user-page{
   		text-align:  center;
   }
   .user-link{
      text-decoration: none;
      border: 1px solid #636b6f;
      padding:  5px;
      border-radius: 5px;
   }
   .user-link:hover{
      background-color: gray;
      color: white;
      text-decoration: none;
   }
   img{
   		width: 300px;
		height: 300px;
   }
   table{
   		margin:  auto;
   }
</style>