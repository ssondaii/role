<template>
	<div>
		<table class="overview">
			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2"><img v-bind:src="currentUser.img" alt="avatar" /></td>
						</tr>
						<tr>
							<td style="text-align: center;"><button @click="isEditImg = !isEditImg">Edit Avatar</button></td>
							<td><button @click="isEdit = !isEdit">Edit Infor</button></td>
						</tr>
					</table>
				</td>
				<td>
					<form>
						<table class="information">
							<tr>
								<td>ID</td>
								<td v-if="isEdit">{{currentUser.id}}</td>
								<td v-else><input type="text" disabled  v-model="currentUser.id"></td>
							</tr>
							<tr>
								<td>Name</td>
								<td v-if="isEdit">{{currentUser.name}}</td>
								<td v-else><input type="text" disabled  v-model="currentUser.name"></td>
							</tr>
							<tr>
								<td>Email</td>
								<td v-if="isEdit">{{currentUser.email}}</td>
								<td v-else><input type="text" disabled  v-model="currentUser.email"></td>
							</tr>
							<tr>
								<td>Address</td>
								<td v-if="isEdit">{{currentUser.address}}</td>
								<td v-else><input type="text" v-model="currentUser.address"></td>
							</tr>
							<tr>
								<td>Age</td>
								<td v-if="isEdit">{{currentUser.age}}</td>
								<td v-else><input type="text" v-model="currentUser.age"></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td v-if="isEdit">{{currentUser.gender}}</td>
								<td v-else>
									<select v-model="currentUser.gender">
										<option value="Male">Male</option>
										<option value="FeMale">FeMale</option>
										<option value="Others">Others</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Role</td>
								<td>{{currentUser.roles[0].name}}</td>
							</tr>
							<tr>
								<td colspan="3"  v-if="!isEdit" style="text-align: justify; border: none;">
									<input type="submit" value="Save"  @click.prevent="updateInfo(currentUser)">
									<input type="submit" value="Candel"  @click="isEdit=!isEdit">
								</td>
							</tr>
						</table>
					</form>
				</td>
			</tr>
		</table>
		<!-- <div style="margin-left: 120px;">
			<form enctype="multipart/form-data">
				<table class="upload-img">
					<tr v-if="isEditImg">
						<td><input type="file" v-on:change="onImageChange" accept="image/*"></td>
					</tr>
					<tr v-if="isEditImg">
						<td><button style="width: 75px;"  @click="uploadImage">Save</button></td>
					</tr>
					<tr v-if="isEditImg">
						<td><button @click="isEditImg = !isEditImg" style="width: 75px;">Cancel</button></td>
					</tr>
				</table>
			</form>
		</div> -->
	</div>
</template>
<script>
	export default{
		data(){
			return{
				currentUser:{
					roles:[{

					}]
				},
				isEdit: true,
				isEditImg: false
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
	    	},
			updateInfo(userEdit){
		        axios.put('/users/' + userEdit.id, {userEdit: userEdit, typeEdit: 2})
		          .then(response => {
		              console.log(response.data.result)
		              this.getCurrentUser()
		              this.isEdit=!this.isEdit
		          })
			}
		}
	};
</script>
<style lang="scss" scoped>
	img{
		width: 300px;
		height: 300px;
	}
	.information tr td{
		border-bottom: 1px solid gray;
		padding: 10px;
	}
	body{
		font-size: 20px;
	}
	.overview{
		margin-top: 100px;
	}
</style>