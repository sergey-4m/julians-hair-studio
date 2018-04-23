<template>
	<aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="img/user2-160x160.jpg" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ $auth.user().first_name }} {{ $auth.user().last_name }}</p>
                    <a href="#" v-if="$auth.check()" v-on:click="$auth.logout()"><i class="fa fa-circle text-success"></i> <strong>Logout</strong></a>
                </div>
            </div>
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">MAIN NAVIGATION</li>
                <!--router-link :to="{name: 'home'}" tag="li" class="treeview">
                	<a>
	                    <i class="fa fa-address-book"></i> <span>Client Service Records</span>
	                </a>
	                <span class="pull-right-container">
                    	<i class="fa fa-angle-left pull-right"></i>
                    </span>
	                <ul class="treeview-menu">
                		<router-link :to="{name: 'cs_create'}" tag="li">
                			<a>
	                			<i class="fa fa-circle-o"></i> <span>Create Record</span>
	                		</a>
                		</router-link>
	                </ul>
                </router-link-->
                <router-link :to="{name: 'home'}" tag="li" class="treeview">
                    <a>
                    	<i class="fa fa-address-book"></i> Client Service Records
                    	<span class="pull-right-container">
                    		<i class="fa fa-angle-left pull-right"></i>
                    	</span>
                    </a>
                    <ul class="treeview-menu">
                        <router-link :to="{name: 'client_service_records_new'}" tag="li">
                            <a>
                            	<i class="fa fa-circle-o"></i> Create Record
                            </a>
                        </router-link>
                    </ul>
                </router-link>
                <li>
                    <a href="#">
                        <i class="fa fa-book"></i> <span>Services</span>
                    </a>
                </li>
                <router-link :to="{name: 'stylists_list'}" tag="li" class="treeview">
                    <a>
                    	<i class="fa fa-cut"></i> Stylists
                    	<span class="pull-right-container">
                    		<i class="fa fa-angle-left pull-right"></i>
                    	</span>
                    </a>
                    <ul class="treeview-menu">
                        <router-link :to="{name: 'stylist_create'}" tag="li">
                            <a>
                            	<i class="fa fa-circle-o"></i> Create Stylist
                            </a>
                        </router-link>
                    </ul>
                </router-link>
                <router-link :to="{name: 'users_list'}" tag="li" class="treeview">
                    <a>
                    	<i class="fa fa-users"></i> Users
                    	<span class="pull-right-container">
                    		<i class="fa fa-angle-left pull-right"></i>
                    	</span>
                	</a>
                    <ul class="treeview-menu">
                        <router-link :to="{name: 'users_create'}" tag="li">
                            <a>
                            	<i class="fa fa-circle-o"></i> Create User
                            </a>
                        </router-link>
                    </ul>
                </router-link>
            </ul>
        </section>
    </aside>
</template>