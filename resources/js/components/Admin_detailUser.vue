<template>
	<div>
		<table class="overview">
			<tr>
				<td>
					<table>
						<tr>
							<td colspan="2"><img v-bind:src="user.img" alt="avatar" /></td>
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
								<td v-if="isEdit">{{user.id}}</td>
								<td v-else><input type="text" disabled  v-model="user.id"></td>
							</tr>
							<tr>
								<td>Name</td>
								<td v-if="isEdit">{{user.name}}</td>
								<td v-else><input type="text" disabled  v-model="user.name"></td>
							</tr>
							<tr>
								<td>Email</td>
								<td v-if="isEdit">{{user.email}}</td>
								<td v-else><input type="text" disabled  v-model="user.email"></td>
							</tr>
							<tr>
								<td>Address</td>
								<td v-if="isEdit">{{user.address}}</td>
								<td v-else><input type="text" v-model="user.address"></td>
							</tr>
							<tr>
								<td>Age</td>
								<td v-if="isEdit">{{user.age}}</td>
								<td v-else><input type="text" v-model="user.age"></td>
							</tr>
							<tr>
								<td>Gender</td>
								<td v-if="isEdit">{{user.gender}}</td>
								<td v-else>
									<select v-model="user.gender">
										<option value="Male">Male</option>
										<option value="FeMale">FeMale</option>
										<option value="Others">Others</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>Role</td>
								<td>{{user.roles[0].name}}</td>
							</tr>
							<tr>
								<td colspan="3"  v-if="!isEdit" style="text-align: justify; border: none;">
									<input type="submit" value="Save"  @click.prevent="updateInfo(user)">
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
				user:{
					roles:[{

					}]
				},
				isEdit: true,
				isEditImg: false
			}
		},
		created(){
			var url_string = window.location.href
			var url = new URL(url_string)
			var user_id = url.searchParams.get("user_id")
			
			this.getUserByID(user_id)
		},
		methods:{
			getUserByID(id){
				axios.get('/users/'+id)
		        .then(response=>{
		            this.user = response.data
		        })
			},
			updateInfo(userEdit){
		        axios.put('/users/' + userEdit.id, {userEdit: userEdit, typeEdit: 2})
		          .then(response => {
		              console.log(response.data.result)
		              this.getUserByID(userEdit.id)
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
		margin: 80px;
	}
</style>