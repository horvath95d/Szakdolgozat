USE timetable;

START TRANSACTION;

CREATE TABLE `users`
(
    `id`                          int(11) NOT NULL,
    `school_id`                   int(11) DEFAULT NULL,
    `username`                    varchar(100) DEFAULT NULL,
    `email`                       varchar(100) NOT NULL,
    `password`                    varchar(60)  NOT NULL,
    `created_on`                  date         NOT NULL,
    `active_end`                  date         NOT NULL,
    `ip_address`                  varchar(45)  NOT NULL,
    `activation_selector`         varchar(255) DEFAULT NULL,
    `activation_code`             varchar(255) DEFAULT NULL,
    `forgotten_password_selector` varchar(255) DEFAULT NULL,
    `forgotten_password_code`     varchar(255) DEFAULT NULL,
    `forgotten_password_time`     int(10) UNSIGNED DEFAULT NULL,
    `remember_selector`           varchar(255) DEFAULT NULL,
    `remember_code`               varchar(255) DEFAULT NULL,
    `last_login`                  int(10) UNSIGNED DEFAULT NULL,
    `active`                      tinyint(1) DEFAULT 1
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `email` (`email`),
    ADD UNIQUE KEY `username` (`username`),
    ADD KEY `school_id` (`school_id`);

ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

-- --------------------------------------------------------

CREATE TABLE `groups`
(
    `id`          mediumint(8) UNSIGNED NOT NULL,
    `name`        varchar(20)  NOT NULL,
    `description` varchar(100) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `groups`
    ADD PRIMARY KEY (`id`);

-- --------------------------------------------------------

CREATE TABLE `login_attempts`
(
    `id`         int(10) UNSIGNED NOT NULL,
    `ip_address` varchar(45)  NOT NULL,
    `login`      varchar(100) NOT NULL,
    `time`       int(10) UNSIGNED DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `login_attempts`
    ADD PRIMARY KEY (`id`);
-- --------------------------------------------------------

CREATE TABLE `users_groups`
(
    `id`       int(10) UNSIGNED NOT NULL,
    `user_id`  int(11) DEFAULT NULL,
    `group_id` mediumint(8) UNSIGNED NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users_groups`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
    ADD KEY `fk_users_groups_users1_idx` (`user_id`),
    ADD KEY `fk_users_groups_groups1_idx` (`group_id`);

ALTER TABLE `users_groups`
    ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
    ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

COMMIT;