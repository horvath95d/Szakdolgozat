USE timetable;

START TRANSACTION;

CREATE TABLE `school`
(
    `id`         int(11) NOT NULL,
    `owner_id`   int(11) NOT NULL,
    `full_name`  varchar(100) DEFAULT NULL,
    `short_name` varchar(15)  DEFAULT NULL,
    `year`       varchar(9)   DEFAULT NULL,
    `days`       tinyint(4) DEFAULT 5,
    `code`       varchar(25)  DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `school`
    ADD PRIMARY KEY (`id`),
    ADD UNIQUE KEY `owner_id` (`owner_id`),
    ADD UNIQUE KEY `full_name` (`full_name`),
    ADD UNIQUE KEY `short_name` (`short_name`);

ALTER TABLE `school`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
    ADD CONSTRAINT `users_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

-- --------------------------------------------------------

CREATE TABLE `subject`
(
    `id`         int(11) NOT NULL,
    `school_id`  int(11) DEFAULT NULL,
    `name`       varchar(30) NOT NULL,
    `short`      varchar(4)  NOT NULL,
    `importance` tinyint(4) DEFAULT 1 COMMENT '1-5',
    `color`      varchar(7)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `subject`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`);

ALTER TABLE `subject`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `subject`
    ADD CONSTRAINT `subject_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

-- --------------------------------------------------------

CREATE TABLE `room`
(
    `id`        int(11) NOT NULL,
    `school_id` int(11) DEFAULT NULL,
    `name`      varchar(25) NOT NULL,
    `members`   tinyint(4) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `room`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`);

ALTER TABLE `room`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `room`
    ADD CONSTRAINT `room_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

CREATE TABLE `room_subject`
(
    `id`         int(11) NOT NULL,
    `school_id`  int(11) NOT NULL,
    `room_id`    int(11) NOT NULL,
    `subject_id` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `room_subject`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`),
    ADD KEY `room_id` (`room_id`),
    ADD KEY `subject_id` (`subject_id`);

ALTER TABLE `room_subject`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `room_subject`
    ADD CONSTRAINT `room_subject_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
    ADD CONSTRAINT `room_subject_fk_2` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `room_subject_fk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE;

-- --------------------------------------------------------

CREATE TABLE `teacher`
(
    `id`            int(11) NOT NULL,
    `school_id`     int(11) DEFAULT NULL,
    `name`          varchar(25) NOT NULL,
    `lesson_number` tinyint(4) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `teacher`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`);

ALTER TABLE `teacher`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `teacher`
    ADD CONSTRAINT `teacher_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

CREATE TABLE `teacher_subject`
(
    `id`         int(11) NOT NULL,
    `school_id`  int(11) NOT NULL,
    `teacher_id` int(11) NOT NULL,
    `subject_id` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `teacher_subject`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`),
    ADD KEY `teacher_id` (`teacher_id`),
    ADD KEY `subject_id` (`subject_id`);

ALTER TABLE `teacher_subject`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `teacher_subject`
    ADD CONSTRAINT `teacher_subject_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
    ADD CONSTRAINT `teacher_subject_fk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `teacher_subject_fk_3` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE;

-- --------------------------------------------------------

CREATE TABLE `class`
(
    `id`         int(11) NOT NULL,
    `school_id`  int(11) DEFAULT NULL,
    `name`       varchar(15) NOT NULL,
    `year`       tinyint(4) NOT NULL,
    `teacher_id` int(11) DEFAULT NULL,
    `room_id`    int(11) DEFAULT NULL,
    `members`    tinyint(4) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `class`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`),
    ADD KEY `teacher_id` (`teacher_id`),
    ADD KEY `room_id` (`room_id`);

ALTER TABLE `class`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `class`
    ADD CONSTRAINT `class_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
    ADD CONSTRAINT `class_fk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE SET NULL,
    ADD CONSTRAINT `class_fk_3` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE SET NULL;

-- --------------------------------------------------------

CREATE TABLE `lesson`
(
    `id`         int(11) NOT NULL,
    `school_id`  int(11) DEFAULT NULL,
    `subject_id` int(11) DEFAULT NULL,
    `class_id`   int(11) DEFAULT NULL,
    `teacher_id` int(11) DEFAULT NULL,
    `room_id`    int(11) DEFAULT NULL,
    `fix_room`   tinyint(4) NOT NULL DEFAULT 0 COMMENT 'true or false',
    `fix_time`   tinyint(4) NOT NULL DEFAULT 0 COMMENT 'true or false',
    `day`        tinyint(4) NOT NULL DEFAULT 0 COMMENT '0-7',
    `time`       tinyint(4) NOT NULL DEFAULT 0,
    `year`       tinyint(4) DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `lesson`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`),
    ADD KEY `subject_id` (`subject_id`),
    ADD KEY `class_id` (`class_id`),
    ADD KEY `teacher_id` (`teacher_id`),
    ADD KEY `room_id` (`room_id`);

ALTER TABLE `lesson`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `lesson`
    ADD CONSTRAINT `lesson_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`),
    ADD CONSTRAINT `lesson_fk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `lesson_fk_3` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE CASCADE,
    ADD CONSTRAINT `lesson_fk_4` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`id`) ON DELETE SET NULL,
    ADD CONSTRAINT `lesson_fk_5` FOREIGN KEY (`room_id`) REFERENCES `room` (`id`) ON DELETE SET NULL;

-- --------------------------------------------------------

CREATE TABLE `event`
(
    `id`        int(11) NOT NULL,
    `school_id` int(11) NOT NULL,
    `name`      varchar(255) NOT NULL,
    `start`     date         NOT NULL,
    `end`       date DEFAULT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `event`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`);

ALTER TABLE `event`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `event`
    ADD CONSTRAINT `event_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

-- --------------------------------------------------------

CREATE TABLE `time`
(
    `id`        int(11) NOT NULL,
    `school_id` int(11) DEFAULT NULL,
    `start`     varchar(5) NOT NULL,
    `end`       varchar(5) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `time`
    ADD PRIMARY KEY (`id`),
    ADD KEY `school_id` (`school_id`);

ALTER TABLE `time`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `time`
    ADD CONSTRAINT `time_fk_1` FOREIGN KEY (`school_id`) REFERENCES `school` (`id`);

COMMIT;