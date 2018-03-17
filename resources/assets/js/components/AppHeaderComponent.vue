<template>
   <header class="app-header" style="height: 59px;padding-top: 11px;">
         <a class="app-header__logo" style="width: 230px;padding: 0px;font-size: 24px;margin-top: 5px;font-family: 'Lato, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, sans-serif';" href="index.html">Royce Asset Manager</a>   
      <!-- Navbar Right Menu-->
      <ul class="app-nav" style="width: 200px;">
     
        <li class="dropdown">
          <a class="app-nav__item" href="#" data-toggle="dropdown">
            <div style="line-height: 19px;text-align: center;">
                <i class="fa fa-user fa-lg"></i>
                <br>
                <div v-if="user != null">{{ user.uid }}</div> 
            </div>
          </a>
        
          <ul class="dropdown-menu settings-menu dropdown-menu-right">
            <li>
                <a class="dropdown-item" href="page-user.html" v-if="user != null"><i class="fa fa-cog fa-lg"></i> Settings</a>
            </li>
            <li>
                <a class="dropdown-item" href="page-user.html" v-if="user != null"><i class="fa fa-user fa-lg"></i> Profile</a>
            </li>
            <li>
              <a class="dropdown-item" href="/login" v-if="user == null"><i class="fa fa-sign-in"></i>Login</a>
              <a class="dropdown-item" href="/logout" v-else><i class="fa fa-sign-out"></i>Logout</a>
            </li>
            
          </ul>
        </li>
      </ul>


  
    </header>
  
</template>

<script>
export default {
  props: {
        user: {
            type: Object,
        },
    },
    methods: {
        login(e) {
            e.preventDefault();
            document.getElementById('login-form').submit()
        }
    },
    mounted() {
        this.csrf = window.laravel.csrfToken;      
    }
}
</script>

<style>

</style>
