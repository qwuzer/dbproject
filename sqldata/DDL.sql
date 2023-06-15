

USE `team14`;

-- 傾印  表格 db_class.student 結構
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StuName` char(50) COLLATE utf8_bin NOT NULL,
  `StuNum` int(11) NOT NULL,
  `passwd` char(50) COLLATE utf8_bin DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;


create table classroom
	(building		varchar(15),
	 room_number		varchar(7),
	 -- capacity		numeric(4,0), 
     branch            varchar(20) -- check (branch in ('Gongguan',)),
	 primary key (room_number)
	) ENGINE=INNODB;

create table department
	(dept_id	    varchar(20), 
	 dept_name		varchar(15), 
	 academy        varchar(20),
	 primary key (dept_id)
	)  ENGINE=INNODB;

create table course
	(serial_no      varchar(11), -- 2878
	 title			varchar(50), 
	 dept_name		varchar(20), 
     course_code    varchar(20), -- CSC9006
     RSG            varchar(20), -- required/selected
     course_level   varchar(20), -- undergraduate/graduate
     semester       numeric(1,0) check (semester in (1,2)),
	 credits		numeric(2,0) check (credits > 0),
	 primary key (serial_no),
	 foreign key (dept_id) references department(dept_id)
		on delete set null
	)  ENGINE=INNODB;


create table instructor
	(name			varchar(20) not null, 
	 -- dept_name		varchar(20), 
	 primary key (name),
	 foreign key (dept_id) references department(dept_id)
		on delete set null
	) ENGINE=INNODB;

create table section
	(sec_id			varchar(8),
     term           varchar(6) check (term in ('Fall', 'Spring')), 
	 academy_yearse			numeric(4,0) check (year > 1701 and year < 2100), 
	 building		varchar(15),
	 room_number		varchar(7),
	 time_slot_id		varchar(4),
	 primary key (course_id, sec_id, semester, year),
	 foreign key (course_id) references course (course_id) 
		on delete cascade,
	 foreign key (building, room_number) references classroom(building, room_number) 
		on delete set null
	) ENGINE=INNODB;

create table teaches
	(name			varchar(20), 
	 serial_no		varchar(10),
	 sec_id			varchar(8), 
	 term		    varchar(6),
	 academy_year			numeric(4,0),
	 primary key (ID, course_id, sec_id, term, academy_year),
	 foreign key (serial_no, sec_id, term, academy_year) references section(course_id, sec_id, term, academy_year) 
		on delete cascade,
	 foreign key (name) references instructor(name)
		on delete cascade
	) ENGINE=INNODB;


create table GE_course
	(category               varchar(20),
     year_of_enrollment     numeric(4,0) check (year_of_enrollment > 1701 and year_of_enrollment < 2100),
     course_id              varchar(10),
     primary key ( category, course_id ),
     foreign key (category, year_of_enrollment) references General_education (category, year_of_enrollment)
        on delete cascade,
     foreign key (course_id) references course(course_id)
        on delete cascade
	) ENGINE=INNODB;


create table General_education
    (category               varchar(20),
     year_of_enrollment     numeric(4,0) check (year_of_enrollment > 1701 and year_of_enrollment < 2100),
     primary key ( category, year_of_enrollment )    
    ) ENGINE=INNODB;


create table time_slot
	(time_slot_id		varchar(4),
	 day			varchar(1),
	 start_hr		numeric(2) check (start_hr >= 0 and start_hr < 24),
	 start_min		numeric(2) check (start_min >= 0 and start_min < 60),
	 end_hr			numeric(2) check (end_hr >= 0 and end_hr < 24),
	 end_min		numeric(2) check (end_min >= 0 and end_min < 60),
	 primary key (time_slot_id, day, start_hr, start_min)
	) ENGINE=INNODB;

create table prereq
	(course_no		varchar(8), 
	 prereq_no		varchar(8),
	 primary key (course_no, prereq_no),
	 foreign key (course_no) references course(serial_no) 
		on update cascade,
	 foreign key (prereq_no) references course(serial_no) 
	) ENGINE=INNODB;


create table post
	(post_id             varchar(5),
     content        varchar(100),
     easiness       numeric(1,0) check (easiness >= 0 and easiness <= 5),
     usefulness     numeric(1,0) check (usefulness >= 0 and usefulness <= 5),
     loading        numeric(1,0) check (loading >= 0 and loading <= 5),
     primary key (post_id)
	) ENGINE=INNODB;


create table user
	(user_id        varchar(5),
     name                varchar(20),
     email               varchar(30),
     password            varchar(20),
     primary key (user_id)
    ) ENGINE=INNODB;
