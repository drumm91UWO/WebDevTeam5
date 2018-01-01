-- phpMyAdmin SQL Dump
-- version 4.4.15.8
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 11, 2017 at 01:46 AM
-- Server version: 5.5.50-MariaDB
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `team5`
--

-- --------------------------------------------------------

--
-- Table structure for table `instructors`
--

CREATE TABLE IF NOT EXISTS `instructors` (
  `id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `number_password_changes` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `salt` varchar(22) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=777778 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `instructors`
--

INSERT INTO `instructors` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `number_password_changes`, `last_login`, `last_logout`, `salt`) VALUES
(5, 'test1', 'test', 'tester', 'test@gmail.com', '$2y$10$UEZiWPdPgu1RhpKR7q62uOZHPKOBBHjEwr9C5PXvF4mBoSTvyS25S', 0, '2017-12-11 01:30:20', '2017-12-11 01:41:15', 'UEZiWPdPgu1RhpKR7q62uZ'),
(666666, 'kreugf', 'Freddy', 'Kreuger', 'inyourdreams@gmail.com', '$2y$12$WXUtW.EOhw.u/8mbbMI4V.p.bbQbrtPzYOyLiH5jnnfVuhA1PHUrW', 0, NULL, NULL, 'WXUtW.EOhw.u/8mbbMI4V.'),
(777777, 'reynd', 'Dennis', 'Reynolds', 'theimplication@gmail.com', '$2y$12$bJ.MLvHJAxj0JcA/YIa8leRTsYmjWBYkX9LdUUwaQUhOSqQOOo/zi', 0, NULL, NULL, 'bJ.MLvHJAxj0JcA/YIa8lk');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL,
  `status` enum('activated','inactive','draft') NOT NULL,
  `question_statement` varchar(100) NOT NULL,
  `correct_answer` varchar(100) NOT NULL,
  `points` int(11) NOT NULL,
  `description` varchar(256) NOT NULL,
  `keywords` varchar(120) NOT NULL,
  `section_number` varchar(20) NOT NULL,
  `number_correct_answers` int(11) DEFAULT NULL,
  `average_points_earned` decimal(10,0) DEFAULT NULL,
  `time_of_activation` datetime DEFAULT NULL,
  `time_of_deactivation` datetime DEFAULT NULL,
  `grader_code` longtext NOT NULL,
  `score_earned` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `status`, `question_statement`, `correct_answer`, `points`, `description`, `keywords`, `section_number`, `number_correct_answers`, `average_points_earned`, `time_of_activation`, `time_of_deactivation`, `grader_code`, `score_earned`) VALUES
(15, 'inactive', 'Internet Protocol is... (select one)', 'A protocol to send data between two computers', 4, 'Question 1', 'internet protocol', '1.1', NULL, NULL, '2017-12-10 14:24:09', '2017-12-10 14:24:14', 'idk', NULL),
(16, 'draft', 'HTML could be described as... (select one)', 'The content of a document', 2, 'Question 2', 'html', '1.1', NULL, NULL, NULL, NULL, 'idk', NULL),
(17, 'activated', 'To use embedded fonts, you must upload a font file to the web server with your HTML and CSS files.', 'True', 2, 'Question 3', 'html, css, font', '1.2', NULL, NULL, '2017-12-10 19:30:59', '2017-12-10 19:30:54', '<script>\n	function grade(){\n		if(document.querySelector(''input[name = "answer"]:checked'')){\n		\n			if(thisIsTheStudentsFirstAnswer()){\n				\n			}\n		}else{\n			alert("You didn''t select an answer");\n		}\n	}\n	function thisIsTheStudentsFirstAnswer(){\n		var studentid = document.getElementById("student").value;\n		var questionid = document.getElementById("question").value;\n		var firstAnswer = true;\n		$.ajax({\n			type: ''POST'',\n			async: false,\n			url: ''../Database_files/getscore.php'',\n			data: { questionid: questionid, studentid: studentid },\n			success: function (result) {\n				var scores = JSON.parse(result);\n				if(scores.length != 0){\n					//do nothing\n					alert("You already answered this question.");\n				}else{\n					gradeAndSubmitAnswer(document.querySelector(''input[name = "answer"]:checked'').value);\n				}\n			},\n		});\n		return firstAnswer;\n	}\n	function gradeAndSubmitAnswer(answer){\n		if(answer == "true"){\n			//submit correct answer\n			var studentid = document.getElementById("student").value;\n			var questionid = document.getElementById("question").value;\n			var score = 2;\n			$.ajax({\n				type: ''POST'',\n				async: false,\n				url: ''../Database_files/makescore.php'',\n				data: {\n					questionid: questionid,\n					studentid: studentid,\n					score: score,\n					answer: answer\n				},\n				success: function (result) {\n					alert("You recieved full credit!");\n				},\n			});\n		}else{\n			//submit incorrect answer\n			var studentid = document.getElementById("student").value;\n			var questionid = document.getElementById("question").value;\n			var score = 0;\n			$.ajax({\n				type: ''POST'',\n				async: false,\n				url: ''../Database_files/makescore.php'',\n				data: {\n					questionid: questionid,\n					studentid: studentid,\n					score: score,\n					answer: answer\n				},\n				success: function (result) {\n					alert("You answered wrong.");\n				},\n			});\n		}\n	}\n</script>\n<form>\n	  <input type="hidden" id="question" value="17">\n	  <input type="number" id="student" value="51261549"> Student id<br>\n	  <input type="radio" name="answer" value="true"> True<br>\n	  <input type="radio" name="answer" value="false"> False<br>\n	  <input type="button" id="submit" value="Submit" onClick="grade()">\n</form>', NULL),
(18, 'draft', 'Select all that are true about absolute positioning.', 'removed from the normal flow; position is set relative to the element''s parent; with no parent avail', 4, 'Question 4', 'absolute, positioning, css', '1.4', NULL, NULL, NULL, NULL, 'idk', NULL),
(19, 'draft', 'Given the following code, what is the output? \\n $age = 16; \\n $alias = &$age; \\n $alias++;', '17', 2, 'Question 5', 'php', '5.4', NULL, NULL, NULL, NULL, 'idk', NULL),
(20, 'inactive', 'What does the function ', 'Returns true if the specified file is uploaded via HTTP POST', 4, 'Question 6', 'php, file, io', '5.4', NULL, NULL, '2017-12-10 14:13:02', '2017-12-10 14:13:14', 'idk', NULL),
(21, 'inactive', 'What does AJAX stand for?', 'asynchronous; javascript; and; xml;', 4, 'Question 7', 'ajax', '12.1', NULL, NULL, '2017-12-10 14:14:29', '2017-12-10 14:14:35', 'idk', NULL),
(22, 'draft', 'Which of the following is the incorrect way to declare a PHP variable?', '$A Variable', 2, 'Question 8', 'php', '5.1', NULL, NULL, NULL, NULL, 'idk', NULL),
(23, 'draft', 'Which of the following is the correct way to use the include command?', 'include "example.php";', 2, 'Question 9', 'php, file, io', '5.1', NULL, NULL, NULL, NULL, 'idk', NULL),
(24, 'draft', 'AJAX has become very commonly used because... (select one)', 'It allows page content to be updated without requiring a full page reload', 2, 'Question 10', 'AJAX', '12.1', NULL, NULL, NULL, NULL, 'idk', NULL),
(25, 'draft', 'JavaScript uses CSS selectors to select elements?', 'True', 2, 'Question 11', 'javascript', '8.2', NULL, NULL, NULL, NULL, 'idk', NULL),
(26, 'draft', 'What does PHP stand for?', 'PHP:Hypertext Preprocessor;', 3, 'Question 12', 'php', '5.1', NULL, NULL, NULL, NULL, 'idk', NULL),
(27, 'draft', 'Which SQL statement is used to extract data from a database?', 'select', 2, 'Question 13', 'sql, database', '13.1', NULL, NULL, NULL, NULL, 'idk', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `scores`
--

CREATE TABLE IF NOT EXISTS `scores` (
  `id` int(8) NOT NULL,
  `student_id` int(8) NOT NULL,
  `question_id` int(8) NOT NULL,
  `score` int(4) DEFAULT NULL,
  `answer` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `scores`
--

INSERT INTO `scores` (`id`, `student_id`, `question_id`, `score`, `answer`) VALUES
(1, 12345678, 15, 4, 'My first answer'),
(2, 24, 15, 4, 'My second answer'),
(3, 54, 15, 3, 'My first answer'),
(4, 24, 15, 4, 'My second answer'),
(5, 54, 15, 3, 'My first answer'),
(6, 5, 15, 5, 'My second answer'),
(7, 46, 15, 3, 'My second answer'),
(8, 4535, 15, 3, 'My third answer'),
(9, 5, 15, 2, 'My second answer'),
(10, 455, 15, 3, 'My third answer'),
(11, 78, 15, 2, 'My second answer'),
(12, 8737, 15, 1, 'My first answer'),
(13, 8727, 15, 1, 'My fourth answer'),
(14, 51261549, 17, 2, 'true'),
(15, 51261548, 17, 0, 'false'),
(16, 51261510, 17, 2, 'true'),
(17, 51261511, 17, 2, 'true'),
(18, 51261512, 17, 2, 'true'),
(19, 51261541, 17, 0, 'false'),
(20, 51261542, 17, 2, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `id` int(11) NOT NULL,
  `username` varchar(12) NOT NULL,
  `first_name` varchar(12) NOT NULL,
  `last_name` varchar(16) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(60) NOT NULL,
  `number_password_changes` int(11) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_logout` datetime DEFAULT NULL,
  `salt` varchar(22) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51261552 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `username`, `first_name`, `last_name`, `email`, `password`, `number_password_changes`, `last_login`, `last_logout`, `salt`) VALUES
(51261549, 'test', 'Tom', 'Tester', 'tester@gmail.com', '$2y$10$2gShkQ7KYLUN32JORoBmiugyky2/.VmbOtR.fHiBN3LzWbk4diKje', 0, '2017-12-11 01:27:05', '2017-12-11 01:30:12', '2gShkQ7KYLUN32JORoBmi4'),
(51261551, 'TheChamp', 'John', 'Cena', 'cantseeme@gmail.com', '$2y$10$gLt75n/kcSM6S1ARnbLlnuWM74J/EUhVenISecDCze.sbaW5e0QdW', 0, '2017-12-11 02:04:13', '2017-12-11 01:12:18', 'gLt75n/kcSM6S1ARnbLlnw');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `instructors`
--
ALTER TABLE `instructors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `scores`
--
ALTER TABLE `scores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `instructors`
--
ALTER TABLE `instructors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=777778;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `scores`
--
ALTER TABLE `scores`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51261552;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
