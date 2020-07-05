create database if not exists vue_rbac charset=utf8;

use vue_rbac;

-- 管理员表
create table if not exists rbac_admin(
    id mediumint unsigned not null auto_increment,
    account varchar(191) not null comment '账户',
    password varchar(191) not null comment '密码',
    salt varchar(191) not null comment '加密盐值',
    status tinyint not null comment '状态 0 - 禁用 1 - 启用',
    created_at datetime,
    updated_at datetime,
    primary key (id),
    unique key uk_account(account)
)charset=utf8,engine=innodb;


-- 管理员附属表
create table if not exists rbac_admin_info(
    id mediumint unsigned  not null auto_increment,
    admin_id mediumint unsigned not null comment '管理员id',
    email varchar(191) comment '邮箱',
    phone varchar(191) comment '电话号码',
    is_can varchar(191) not null comment '是否开启邮箱发送 0 - 未开启 1 - 已开启',
    created_at datetime,
    updated_at datetime,
    primary key (id),
    unique key uk_email (email),
    unique key uk_phone (phone),
    index idx_admin_id (admin_id)
)charset=utf8,engine=innodb;


-- 角色表
create table if not exists rbac_role(
    id mediumint unsigned  not null auto_increment,
    role_name varchar(191) not null comment '角色名称',
    status tinyint not null comment '状态 0 - 禁用 1 - 启用',
    created_at datetime,
    updated_at datetime,
    primary key (id),
    unique key uk_role_name (role_name)
)charset=utf8,engine=innodb;


-- 角色管理员中间表
create table if not exists rbac_admin_role(
     id mediumint unsigned  not null auto_increment,
     role_id mediumint unsigned  not null comment '角色id',
     admin_id   mediumint unsigned  not null comment '管理员id',
     created_at datetime,
     updated_at datetime,
     primary key (id),
     key idx_role_id(role_id),
     key idx_admin_id(admin_id)
)charset=utf8,engine=innodb;


-- 权限表
create table if not exists rbac_permission(
     id mediumint unsigned  not null auto_increment,
     name varchar(191) not null comment '权限名称',
     pid mediumint unsigned  not null  comment '父级id 0 为最顶级id',
     pid_str varchar(191) not null comment '权限家族图谱,是一个冗余字段，便于查询,如果是父级id就表示自身id，使用-进行分割',
     path varchar(191) not null comment '后端标识',
     slug varchar(191) not null comment '前端标识,路由',
     is_menu tinyint not null comment '是否菜单 0 - 否 1 - 是',
     created_at datetime,
     updated_at datetime,
     primary key (id),
     unique key uk_name(name)
)charset=utf8,engine=innodb;


-- 角色权限中间表
create table if not exists rbac_role_permission(
     id mediumint unsigned  not null auto_increment,
     role_id mediumint unsigned  not null comment '角色id',
     permission_id  mediumint unsigned  not null comment '权限id',
     created_at datetime,
     updated_at datetime,
     primary key (id),
     key idx_role_id(role_id),
     key idx_permission_id(permission_id)
)charset=utf8,engine=innodb;

