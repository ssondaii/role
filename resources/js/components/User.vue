<template>
   <div class="user-management">
        <div class="create-user container">
          <div>Add User</div>
          <div class="row">
            <div class="col-md-3">
              <input type="text" v-model="userCreate.name" class="form-control" placeholder="Name...">
            </div>
            <div class="col-md-3">
              <input type="email" v-model="userCreate.email" class="form-control" placeholder="User email...">
            </div>
            <div class="col-md-3">
              <select class="form-control" v-model="userCreate.role">
                <option v-bind:value="rol.name"  v-for="rol in listRole">{{rol.name}}</option>
              </select>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" @click="createUser">Create</button>
            </div>
          </div>
        </div>
        <br>
        <div class="edit-user container">
          <div>Edit User</div>
          <div class="row" style="border-color: blue;">
            <div class="col-md-3">
              <input type="text" v-model="userEdit.name" class="form-control">
            </div>
            <div class="col-md-3">
              <input type="email" v-model="userEdit.email" class="form-control">
            </div>
            <div class="col-md-3">
              <select class="form-control" v-model="userEdit.newRole">
                <option v-bind:value="rol.name"  v-for="rol in listRole">{{rol.name}}</option>
              </select>
            </div>
            <div class="col-md-3">
              <button class="btn btn-primary" @click="updateUser(userEdit)" style="background-color: orange;">Update</button>
            </div>
          </div>
        </div>

       <div class="list_user table-responsive container">
        	<table class="table table-hover">
        		<thead>
        			<tr>
        				<td>ID</td>
        				<td>Name</td>
        				<td>Email</td>
        				<td>Role</td>
        				<td>Action</td>
        			</tr>
        		</thead>
        		<tbody v-if="list_users.length">
        			<tr v-for="user in list_users">
        				<td>{{ user.id }}</td>
        				<td>{{ user.name }}</td>
        				<td>{{ user.email }}</td>
        				<td>
        					<span v-for="role in user.roles">{{ role.name }}</span>
        				</td>
        				<td>
        					<button class="btn btn-success" @click="editUser(user)">Edit</button>
        					<button class="btn btn-danger" @click="deleteUser(user)">Delete</button>
                  <button class="btn btn-info" @click="detailUser(user)">Detail</button>
        				</td>
        			</tr>
        		</tbody>
        	</table>
        </div>
   </div>
</template>

<script>
   export default {
		data() {
			return {
        userCreate: {
            name: '',
            email: '',
            role: 'employee'
        },
        userEdit:{
            id: 0,
            name: '',
            email: '',
            newRole: '',
            oldRole: ''
        },
				currentUser: {},
				list_users: [],
        listRole: []
			}
		},
		created() {
			this.getCurrentUser()
			this.getListUsers()
      this.getListRole()
		},
		methods: {
      detailUser(user){
        window.location.href = '/Admin_detailUser?user_id='+user.id
          // axios.get('/users/'+user.id)
          // .then(response=>{
          //   console.log('call detailUser() in User.vue'),
          //   user = response.data,
          //   window.location.href = '/Admin_detailUser?user_id='+user.id
          // })
      },
      deleteUser(user){
          axios.delete('/users/'+user.id, {userDelete: user})
          .then(response=>{
            console.log(response.data.result),
            this.getListUsers()
          })
      },
      updateUser(userEdit){
          axios.put('/users/' + userEdit.id, {userEdit: this.userEdit, typeEdit: 1})
          .then(response => {
              console.log(response.data.result),
              this.getListUsers()
          })
      },
      editUser(user){
        this.userEdit.id = user.id,
        this.userEdit.name = user.name,
        this.userEdit.email = user.email,
        this.userEdit.newRole = user.roles[0].name,
        this.userEdit.oldRole = user.roles[0].name
      },
      getListRole(){
        axios.get('/roles')
        .then(response=>{
          this.listRole = response.data
        })
      },
	     getCurrentUser() {
	    		axios.get('/getCurrentUser')
  				.then(response => {
  					this.currentUser = response.data
  				})
  				.catch(error => {
  					console.log(error)
  				})
	    	},
	    	getListUsers() {
                axios.get('/users')
                .then(response => {
                    this.list_users = response.data
                })
                .catch(error => {
                    console.log(error)
                })
			},
      createUser() {
          axios.post('/users', {user: this.userCreate})
          .then(response => {
              console.log(response)
              this.userCreate = {}
              this.getListUsers()
          })
          .catch(error => {
              console.log(error)
          })
      },
		}
	};
</script>

<style lang="scss" scoped>
  .row{
    border: 1px solid green;
    padding: 20px 5px;
  }
</style>
