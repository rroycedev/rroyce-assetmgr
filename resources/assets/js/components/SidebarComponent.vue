<template>
  <!-- Sidebar menu-->
  <div>
    <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
    <aside class="app-sidebar">
      <div class="app-sidebar__user" v-if="username != ''"> <i class="fa fa-user fa-4x" style="margin-right: 5px;"></i>
        <!-- <img class="app-sidebar__user-avatar" src="https://s3.amazonaws.com/uifaces/faces/twitter/jsa/48.jpg" alt="User Image"> -->
        <div style="margin-top: auto;margin-bottom: auto;">      
            <p class="app-sidebar__user-name" id="logged_in_user_fullname">{{ username }}</p>
            <p class="app-sidebar__user-designation">{{ groupname }}</p>                
        </div>
      </div>
      <ul class="app-menu" v-if="username != ''">
      
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-laptop"></i><span class="app-menu__label">Hardware</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="bootstrap-components.html"><i class="icon fa fa-circle-o"></i> Bootstrap Elements</a></li>
            <li><a class="treeview-item" href="http://fontawesome.io/icons/" target="_blank"><i class="icon fa fa-circle-o"></i> Font Icons</a></li>
            <li><a class="treeview-item" href="ui-cards.html"><i class="icon fa fa-circle-o"></i> Cards</a></li>
            <li><a class="treeview-item" href="widgets.html"><i class="icon fa fa-circle-o"></i> Widgets</a></li>
          </ul>
        </li>
       <li><a class="app-menu__item" href="charts.html"><i class="app-menu__icon fa fa-pie-chart"></i><span class="app-menu__label">Software</span></a></li>

        <li><a class="app-menu__item" href="/user"><i class="app-menu__icon fa fa-user"></i><span class="app-menu__label">Users</span></a></li>
       
      </ul>
    </aside>  
    </div>
</template>

<script>
export default {
    props: {
        username: {
            type: String
        },
        groupname: {
            type: String
        }
    }
}
</script>

<style>

</style>
