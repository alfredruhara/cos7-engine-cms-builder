-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 10, 2019 at 03:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cos_blog_1.1`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(20) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` longtext NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_id` int(99) DEFAULT NULL,
  `category_id` int(255) DEFAULT NULL,
  `sub_category_id` int(99) DEFAULT NULL,
  `user_id` int(11) NOT NULL DEFAULT '1',
  `media_file` varchar(255) DEFAULT NULL,
  `youtube_video_link` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `switch` enum('on','off') DEFAULT 'off',
  `switch_comment` enum('on','off') NOT NULL DEFAULT 'on',
  `switch_attach` enum('video','image') NOT NULL DEFAULT 'image',
  `tags` varchar(255) DEFAULT NULL,
  `title_tag_contents` varchar(255) DEFAULT NULL,
  `desc_meta_tag_content` varchar(255) DEFAULT NULL,
  `keyword_meta_tag_content` varchar(255) DEFAULT NULL,
  `comment_count` int(99) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `date`, `menu_id`, `category_id`, `sub_category_id`, `user_id`, `media_file`, `youtube_video_link`, `button_link`, `switch`, `switch_comment`, `switch_attach`, `tags`, `title_tag_contents`, `desc_meta_tag_content`, `keyword_meta_tag_content`, `comment_count`) VALUES
(17, 'God Of War 2018', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam', '2018-07-04 17:10:21', 3, 6, 2, 2, 'eTH9jM86wTNAqiH/godofwar.jpg', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(15, 'Black list ', 'the Black list\r\nThe Peacock Network is sticking with Red. Today, the The Blacklist TV show was renewed for a sixth season, of 22 episodes, on NBC. The Blacklist season six renewal was announced by NBC on its official Twitter page. Check it out, below. \r\nAn action thriller, The Blacklist centers on one of the FBI’s most wanted fugitives, Raymond “Red” Reddington (James Spader) who offers to help the authorities, if rookie agent Elizabeth Keen (Megan Boone) partners with him. The cast also includes Diego Kattenhoff, Ryan Eggold, Harry Lennix, Amir Arison, Mozhan Marnò, and Hisham Tawfiq.\r\n\r\n', '2018-07-03 23:08:44', 2, 8, 0, 1, '8bNG8gGg3CT116b/blacklist.jfif', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(16, 'Prison Break ', 'God bless Prison Break – never knowingly un-ridiculous, the revived FOX series wrapped its fifth season with a totally outrageous finale.\r\n\'Behind the Eyes\' delivered two absurd plot twists and a happy ending for Michael Scofield (Wentworth Miller), but with fans still clamouring for more, was this really goodbye?\r\nHere\'s everything you need to know about the show\'s potential future, following its brief but blissful comeback.\r\nPrison Break season 6: Is it happening?\r\nYes! In January 2018, FOX officially confirmed that it was \"developing a new iteration\" of Prison Break. \"It\'s in very early stages of development,\" said entertainment president Michael Thorn. \"But we\'re really excited about it.\"\r\nSpeaking about the revival mini-series back in 2016, Sarah Wayne Callies (who plays Sara Tancredi) said: \"This was pitched as, \'We\'re gonna do 9 episodes, drop the mic and walk away\' and I\'m fine with that.\"\r\nBut, even back then, her co-star Miller was more open to the possibility of bringing Prison Break back again: \"There\'s always room for more, in my mind,\" he said. \"As long as it\'s a story that\'s worth telling, as long as it feels justified and cool and edgy.\r\n\"It has to be something that\'s not going to let the fans down, that\'s going to satisfy and surprise. I\'m open to the conversation.\"\r\nSpeaking to Digital Spy later that year, he reiterated his position: \"Depending on how [the revival\'s] received, and who\'s available, there could be another conversation about another bite of the apple.\"\r\nWith Michael and Sara\'s son Mike Jr. (Christian Michael Cooper) now a key part of the series, Miller said: \"I feel like there\'s more story there and now we\'re talking about multiple generations.\"\r\nDominic Purcell (Lincoln Burrows) was even more keen, insisting in April 2017 that he\'d \"do years\" of the show, and \"would love to do season six\".\r\nBut then, a rock in the road – series creator Paul Scheuring said that despite \"desire... from fans... and some of the actors\", he saw the new revival as \"a closed-ended story\".\r\n\"Part of the problem with the original show was that we had to keep flapping our wings and keep extending,\" he argued. \"I feel like the fans suffered for that, because as some point, you run out of narrative and you start making up stuff that\'s lesser quality.\"\r\nThis was the big problem, according to Scheuring: coming up with a story that would satisfy. \"I couldn\'t tell you another story about this group of people,\" he said. \"Maybe somebody else can, or by accident I\'ll somehow, possibly, dream up another prison escape that\'s new and fresh, but I would bet against it.\"\r\nHowever, by the time Scheuring spoke at TV festival PaleyFest in March, his stance appeared to have softened.\r\n\"We as a group have to arrive at a story that we feel is worth telling. Creative integrity is really important and if we could arrive at a story that we felt was worthwhile… then it\'s possible.\r\n\"It all comes from Fox ultimately… another season wouldn\'t happen unless they felt it was within their interest.\"\r\nHappily, FOX top dog Dana Walden stated that the network would \"definitely consider doing more episodes\" – which meant the ball was now back in Scheuring\'s court.\r\nIn August 2017, then-FOX entertainment boss David Madden confirmed, as of August 2017, there was \"nothing\" in the works for Prison Break. \"If the producers have a thought about how to explore another iteration of it, we\'d be excited to talk,\" he added.\r\nThen, an early Christmas present on December 13: Dominic Purcell announced on Instagram that a sixth season was actually \"in the works\" - with FOX officially confirming more episodes a little under a month later.\r\nRelated: Will Prison Break season 6 ever happen? We examine the evidence \r\nPrison Break season 6 episodes: What\'s the plot?\r\nThe latest season ended with Michael granted full immunity for the crimes he committed while under the thrall of rogue CIA agent Poseidon (Mark Feuerstein), leaving our hero free to play happy families with Sara and Mike Jr.\r\nThat said, co-showrunner Vaun Wilmott has confirmed that \"ideas are percolating\" for a sixth season, so what might the future hold for Michael and the gang, when Prison Break returns? Beyond, y\'know, another prison break.\r\n\'Behind the Eyes\' might contain a hint as the show\'s possible next step, with the director of the CIA (Ken Tremblett) offering Michael a job that would utilise his particular set of skills.\r\nMichael turned the gig down – but might a change in circumstances force him to reconsider?\r\nInterestingly, Scheuring\'s original ending for the recent mini-series suggested that Scofield would indeed struggle to settle down. \"The idea was Michael comes back and he\'s apparently got a normal life, but with that comes a creeping paranoia that things can\'t stay good like this.\r\n\"Unfortunately, that\'s not on screen, but... hopefully the audience gets the subtext that life will never be normal for Michael Scofield.\"\r\nIn March 2018, Scheuring hinted that season six would be \"going back to the beginning... literally the very first frames\" of Prison Break - possibly hinting at a prequel angle, or maybe a flashback twist that would change everything we thought we knew?\r\nWentworth Miller, it turns out, also had his own ideas about where season six should go. In an Instagram post, he revealed a (rejected) pitch he sent to \"the powers-that-be\".\r\nMiller - who is also a screenwriter - conceived of a totally meta take on Prison Break, where Michael and Lincoln were thrown into a specially-designed prison and made to relive their past adventures by \'Tag\' - their psychotic long-lost brother.\r\nBut given that FOX apparently \"weren\'t interested\" in the pitch, we\'re guessing season six wouldn\'t include any of these elements when it makes it to the air.\r\nPrison Break season 6 release date: When would it air?\r\nThe bad news: while Prison Break is coming back, it probably won\'t be for a while.\r\nIn March 2018, Paul Scheuring announced that he\'d completed the script for episode 6x01, but factor in availability of cast and we wouldn\'t expect the new season to air until at least 2019.\r\n\"It\'s definitely not something we want to do every season – we want to make it special,\" said Dana Walden in 2017, explaining that the show is more likely to return intermittently, either for another mini-series or a one-off.\r\nPrison Break season 6 cast: Who will star?\r\n\"If the right storyline comes along, I am sure the gang would be back to do it again,\" said Vaun Wilmott, implying that any main character still breathing at the end of the latest mini-series could be back.\r\nSo that includes...\r\n• Wentworth Miller (Michael Scofield)\r\n• Dominic Purcell (Lincoln Burrows)\r\n• Sarah Wayne Callies (Sara Tancredi-Scofield)\r\n• Rockmond Dunbar (C-Note)\r\n• Robert Knepper (T-Bag)\r\n• Amaury Nolasco (Sucre)\r\n• Inbar Lavi (Sheba)\r\nMike Jr. would also be part of any future iteration, while recurring character Ja (Rick Yune) is also a possibility.\r\nSeries original Kellerman (Paul Adelstein) was spectacularly killed off in the latest episodes, but that hasn\'t stop Adelstein from hinting that the hitman-turned-politician could still \r\n\"I don\'t see it as his swan song,\" he said. \"I mean, it\'s Prison Break. In all seriousness, how can you ever really know if you should believe what you see?\"\r\nHe\'s not wrong – after all, both Michael and Sara have now successfully come back from the dead, so anything\'s possible.\r\nOne major character missing from the revival was ex-FBI special agent Alexander Mahone (William Fichtner), but could he have a part to play next season?\r\n\"Paul loves Bill Fichtner and I love Bill Fichtner,\" Robert Knepper said at 2016\'s San Diego Comic-Con. \"He\'s a brilliant actor – but Paul honestly said to me, \'I don\'t know what to do with that character\'.\r\n\"He didn\'t want to just bring everybody back, so that the audience go, \'Oh, look, it\'s Bill Fichtner again!\' – he honestly thought, \'I\'m not sure where to do that in the plot,\' so if someday there\'s another chapter of this, maybe then Bill will be back.\"\r\nScheuring himself later tweeted that there was \"somewhere between [a] 50-150 percent chance\" that Mahone will be back for season six... so fingers crossed!\r\nScheuring couldn\'t find much room for fan-favourite character Fernando Sucre in the revival either – he played a major role in just one of the nine episodes. But that could also change next time round.\r\n\"All characters had to be organically within the series and he didn\'t really have a role other than being the sidekick running around in Yemen, which he really didn\'t have a skill set for,\" the writer explained.\r\n\"So I wish there could\'ve been more Sucre. It would have been creatively disingenuous to include him more than that, but if there\'s another season, maybe there\'s way more Sucre.\"\r\n', '2018-07-03 23:08:44', 2, 8, 0, 1, '8bNG8gGg3CT116b/break.jfif', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(18, 'Aqua Man 2019', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..', '2018-07-04 17:10:21', 1, 1, 7, 1, 'BhsLe5E0k1EiJnc/aquaman.jpg', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(19, 'The Amazon 2019', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, ..Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam ', '2018-07-04 17:15:51', 1, 1, 7, 1, 'BhsLe5E0k1EiJnc/amazon.jpg', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(20, ' The Walking Dead', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-07-06 07:25:15', 4, 0, 0, 1, 'ETXVnbjg8lhbSI3/walkingdead.jfif', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(21, 'Comming back -Game of Throne', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. Duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2018-07-06 07:25:15', 4, 0, 0, 1, 'ETXVnbjg8lhbSI3/gameofthrone.jpg', NULL, NULL, 'on', 'on', 'image', NULL, NULL, NULL, NULL, 0),
(24, 'test post', 'here is the first test', '2018-07-10 23:23:00', 1, NULL, NULL, 1, '', 'https://www.cool.com', NULL, 'on', 'off', 'video', 'test', 'test', 'test', 'test', 0),
(25, 'test post', 'date', '2018-07-23 04:56:54', 1, NULL, NULL, 1, '', NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(26, 'upload test', 'hello upload', '2018-07-23 05:53:33', 1, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(27, 'upload error', 'why this error', '2018-07-23 05:56:07', 1, NULL, NULL, 1, 'BhsLe5E0k1EiJnc/N86Rv2krUPNf.jpeg', NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(28, 'menu directory created', 'test artice', '2018-07-23 06:55:42', 1, NULL, NULL, 1, 'BhsLe5E0k1EiJnc/1sywfPqyOmlA.jpg', NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(29, 'last upload test', 'last upload test', '2018-07-23 06:57:27', 23, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(31, 'html', '&lt;h1&gt;this is heading 1&lt;/h1&gt;\r\n&lt;h2&gt;this is heading 2&lt;/h2&gt;\r\n&lt;h3&gt;this is heading 3&lt;/h3&gt;\r\n&lt;h4&gt;this is heading 4&lt;/h4&gt;\r\n&lt;h5&gt;this is heading 5&lt;/h5&gt;\r\n&lt;h6&gt;this is heading 6&lt;/h6&gt;', '2018-07-24 16:13:20', 1, NULL, 3, 1, 'BhsLe5E0k1EiJnc/GsKAXCfebFiG.jpg', NULL, NULL, 'on', 'on', 'image', 'test news,tag test,nothing better', 'article', 'where are testing heading', 'heading test h1 h2 h3 h4 h4', 0),
(32, 'bingo', '&lt;h1&gt;this is heading 1&lt;/h1&gt;\r\n&lt;h2&gt;this is heading 2&lt;/h2&gt;\r\n&lt;h3&gt;this is heading 3&lt;/h3&gt;\r\n&lt;h4&gt;this is heading 4&lt;/h4&gt;\r\n&lt;h5&gt;this is heading 5&lt;/h5&gt;\r\n&lt;h6&gt;this is heading 6&lt;/h6&gt;\r\n\r\n &lt;h1&gt;this is heading 1&lt;/h1&gt;\r\n&lt;h2&gt;this is heading 2&lt;/h2&gt;\r\n&lt;h3&gt;this is heading 3&lt;/h3&gt;\r\n&lt;h4&gt;this is heading 4&lt;/h4&gt;\r\n&lt;h5&gt;this is heading 5&lt;/h5&gt;\r\n&lt;h6&gt;this is heading 6&lt;/h6&gt;', '2018-07-24 16:20:08', 1, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(33, 'last tes', '&lt;h1&gt;this is heading 1&lt;/h1&gt;\r\n&lt;h2&gt;this is heading 2&lt;/h2&gt;\r\n&lt;h3&gt;this is heading 3&lt;/h3&gt;\r\n&lt;h4&gt;this is heading 4&lt;/h4&gt;\r\n&lt;h5&gt;this is heading 5&lt;/h5&gt;\r\n&lt;h6&gt;this is heading 6&lt;/h6&gt;\r\n\r\n &lt;h1&gt;this is heading 1&lt;/h1&gt;\r\n&lt;h2&gt;this is heading 2&lt;/h2&gt;\r\n&lt;h3&gt;this is heading 3&lt;/h3&gt;\r\n&lt;h4&gt;this is heading 4&lt;/h4&gt;\r\n&lt;h5&gt;this is heading 5&lt;/h5&gt;\r\n&lt;h6&gt;this is heading 6&lt;/h6&gt;', '2018-07-24 16:23:19', 2, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(34, 'test finale maraba', '&lt;h1&gt;this is heading 1&lt;/h1&gt;\r\n&lt;h2&gt;this is heading 2&lt;/h2&gt;\r\n&lt;h3&gt;this is heading 3&lt;/h3&gt;\r\n&lt;h4&gt;this is heading 4&lt;/h4&gt;\r\n&lt;h5&gt;this is heading 5&lt;/h5&gt;\r\n&lt;h6&gt;this is heading 6&lt;/h6&gt;\r\n&lt;br/&gt;', '2018-07-24 16:25:03', 23, NULL, NULL, 1, 'PxzwW4TTCR/5PgEnBfNzozB.jpg', NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(35, 'ds', 'asdas', '2018-07-24 16:37:05', 23, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 1),
(36, 'sgdg', 'sddfs', '2018-07-24 16:38:14', 23, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(37, 'bingo', 'fakfa', '2018-07-24 16:39:24', 23, NULL, NULL, 1, NULL, NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(38, 'klh', 'hjb', '2018-07-24 16:41:11', 1, NULL, NULL, 1, 'BhsLe5E0k1EiJnc/5I7OpAHcVKRD.png', NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(39, 'file', 'sadsd', '2018-07-24 16:41:52', 1, NULL, NULL, 1, 'BhsLe5E0k1EiJnc/ofjB2gDCl2HF.jpg', NULL, NULL, 'off', 'on', 'image', '', '', '', '', 0),
(47, 'tdd', 'dxfxd', '2019-03-04 07:19:46', 2, 8, NULL, 1, NULL, NULL, NULL, 'on', 'on', 'image', '', '', '', '', 0),
(48, 'athanas', 'lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod\r\ntempor incididunt ut labore et dolore magna aliqua. ut enim ad minim veniam,\r\nquis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo\r\nconsequat. duis aute irure dolor in reprehenderit in voluptate velit esse\r\ncillum dolore eu fugiat nulla pariatur. excepteur sint occaecat cupidatat non\r\nproident, sunt in culpa qui officia deserunt mollit anim id est laborum.', '2019-03-21 09:07:15', 1, 4, 6, 1, NULL, NULL, NULL, 'on', 'on', 'image', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `backofficeconfig`
--

CREATE TABLE `backofficeconfig` (
  `id` int(99) NOT NULL,
  `table_name` varchar(20) DEFAULT '',
  `view` enum('table','card') NOT NULL DEFAULT 'table',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `backofficeconfig`
--

INSERT INTO `backofficeconfig` (`id`, `table_name`, `view`, `date`) VALUES
(1, 'slider', 'card', '2018-07-27 11:49:38'),
(2, 'listarticle', 'table', '2018-07-28 17:40:44');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(99) NOT NULL,
  `title` varchar(200) NOT NULL,
  `menu_id` int(99) NOT NULL,
  `switch_category` enum('on','off') NOT NULL DEFAULT 'on',
  `date` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `title`, `menu_id`, `switch_category`, `date`) VALUES
(1, 'action', 1, 'on', '2018-06-12 00:08:21'),
(2, 'dramatic', 1, 'on', '2018-05-23 09:21:32'),
(3, 'Comics', 1, 'on', '2018-07-03 23:13:28'),
(4, 'Adventure', 1, 'on', '2018-07-03 23:13:28'),
(5, 'Horror', 2, 'on', '2018-07-03 23:28:47'),
(6, 'PlayStation', 3, 'on', '2018-07-04 17:11:32'),
(7, 'Comics', 2, 'on', '2018-07-05 08:21:25'),
(8, 'Dramatic', 2, 'on', '2018-07-05 08:25:36'),
(15, 'category test', 23, 'on', '2018-07-24 17:24:03'),
(16, 'hello', 23, 'on', '2018-08-06 14:17:49');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(99) NOT NULL,
  `parent_id` int(99) DEFAULT NULL COMMENT 'its an comment id ... saving this when replied to a comment . Foreign key = reference comment table (id column ) . default null ',
  `post_id` int(99) NOT NULL COMMENT 'Saving this  when commented on an article . its a foreign key = reference article table (id column) : Not null  ',
  `email` varchar(200) NOT NULL,
  `full_name` varchar(200) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pending` enum('1','0') NOT NULL DEFAULT '0' COMMENT 'Awaiting validation comment : 1 : True (Yes)  0 : False (No)',
  `moved_to_trash` enum('1','0') NOT NULL DEFAULT '0' COMMENT '1 =  true ( yes ) and 0 = false ( No )',
  `spam` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1 : true (Yes ) and 0 :false ( No )'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `parent_id`, `post_id`, `email`, `full_name`, `comment`, `date`, `pending`, `moved_to_trash`, `spam`) VALUES
(1, NULL, 5, 'cos@gmail.com', 'Alfred Chadrack', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim venia ', '2018-07-03 20:10:55', '0', '0', '0'),
(2, NULL, 5, 'whonet@gamil.com', 'Who Network', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugi.', '2018-07-03 20:10:55', '0', '0', '0'),
(10, NULL, 5, 'avatar@gmail.com', 'bethefirst', 'its kind of crazy stuff ! but i realy  appreciate what marvel done .. so far i never seen such spider man movie\r\n....keep up', '2018-07-31 19:49:20', '1', '0', '0'),
(5, 1, 5, 'chada@email.com', 'Alfred Default', 'lorem ipsum dolor sit amet consectetur, adipisicing elit. nisi ut temporibus ratione nemo et, est quos quo \r\nexpedita reiciendis \r\nquidem ullam voluptate ab omnis error molestias unde praesentium nam tempore!', '2018-07-30 16:15:13', '0', '0', '0'),
(9, NULL, 5, 'avatar@gmail.com', 'bethefirst', 'its kind of crazy stuff ! but i realy  appreciate what marvel done .. so far i never seen such spider man movie\r\n....keep up', '2018-07-31 19:49:02', '1', '0', '0'),
(7, 6, 5, 'chada@email.com', 'Alfred Default', 'me too ! but we still waiting the upcoming version .... marvel forever', '2018-07-30 16:47:07', '0', '1', '0'),
(8, NULL, 13, 'chada@email.com', 'Alfred Default', '#fake movie ever seen ! sorry marvel', '2018-07-30 18:31:11', '0', '0', '0'),
(11, NULL, 37, 'chada@email.com', 'Alfred Default', 'bingo flash commented', '2018-08-08 20:19:17', '0', '0', '0'),
(12, NULL, 39, 'chada@email.com', 'Alfred Default', 'file commented', '2018-08-08 20:20:05', '0', '0', '0'),
(13, NULL, 39, 'chada@email.com', 'Alfred Default', 'bingo bingo bingo', '2018-08-08 20:21:57', '0', '0', '0'),
(14, NULL, 35, 'chada@email.com', 'Alfred Default', 'hello word 3 times', '2018-08-08 20:25:27', '0', '0', '0'),
(15, NULL, 35, 'chada@email.com', 'Alfred Default', 'hello word 3 times', '2018-08-08 20:25:31', '1', '1', '0'),
(17, 15, 35, 'chada@email.com', 'Alfred Default', 'very rights', '2018-08-10 15:45:26', '0', '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `display`
--

CREATE TABLE `display` (
  `id` int(99) NOT NULL,
  `category` enum('tab','dropdown') NOT NULL DEFAULT 'tab',
  `subcategory` enum('card','dropdown') NOT NULL DEFAULT 'card',
  `date_display` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `display`
--

INSERT INTO `display` (`id`, `category`, `subcategory`, `date_display`) VALUES
(1, 'dropdown', 'dropdown', '2018-07-12 23:48:10');

-- --------------------------------------------------------

--
-- Table structure for table `globalpoint`
--

CREATE TABLE `globalpoint` (
  `id` int(99) NOT NULL,
  `description` varchar(120) NOT NULL,
  `user_id` int(99) NOT NULL DEFAULT '1',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `globalpoint`
--

INSERT INTO `globalpoint` (`id`, `description`, `user_id`, `date`) VALUES
(1, 'Third menu created', 1, '2018-07-20 05:48:29'),
(2, 'New menus have been created', 1, '2018-07-20 06:27:28'),
(3, 'Initial state, Website is runnig too fast ', 1, '2018-07-20 06:27:28'),
(4, 'Menu finished to build', 1, '2018-07-20 06:43:32'),
(5, 'Menu finished to build', 1, '2018-07-20 06:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(99) NOT NULL,
  `menu` varchar(100) NOT NULL,
  `switch_menu` enum('on','off') NOT NULL DEFAULT 'on',
  `date_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `menu_dir` varchar(100) DEFAULT NULL,
  `view_media_of_this` enum('table','card') DEFAULT 'table'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `menu`, `switch_menu`, `date_created`, `menu_dir`, `view_media_of_this`) VALUES
(1, 'cinemax', 'on', '2018-07-05 08:03:27', 'BhsLe5E0k1EiJnc', 'card'),
(2, 'series', 'on', '2018-07-05 08:03:27', '8bNG8gGg3CT116b', 'card'),
(4, 'news', 'off', '2018-07-05 08:04:05', 'ETXVnbjg8lhbSI3', 'table'),
(23, 'menu dir', 'on', '2018-07-23 07:49:49', 'PxzwW4TTCR', 'table'),
(3, 'Game', 'on', '2018-07-23 11:58:29', 'eTH9jM86wTNAqiH', 'table'),
(28, 'webdesign', 'on', '2019-03-04 11:13:43', '11Mw5ztxE4', 'table'),
(30, 'leader', 'on', '2019-05-08 20:31:09', 'CQRZUxJLqE', 'table'),
(31, 'gliz', 'on', '2019-06-04 09:16:24', 'HAiPruxDxL', 'table');

-- --------------------------------------------------------

--
-- Table structure for table `menusetting`
--

CREATE TABLE `menusetting` (
  `id` int(99) NOT NULL,
  `sort_by` varchar(10) NOT NULL DEFAULT 'id',
  `use_order` varchar(15) NOT NULL DEFAULT 'asc',
  `date_setting` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `menusetting`
--

INSERT INTO `menusetting` (`id`, `sort_by`, `use_order`, `date_setting`) VALUES
(1, 'date', 'asc', '2018-07-13 03:15:22');

-- --------------------------------------------------------

--
-- Table structure for table `point`
--

CREATE TABLE `point` (
  `id` int(99) NOT NULL,
  `menu_id` int(99) NOT NULL,
  `description` varchar(120) NOT NULL,
  `user_id` int(99) NOT NULL DEFAULT '1',
  `date_point` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `point`
--

INSERT INTO `point` (`id`, `menu_id`, `description`, `user_id`, `date_point`) VALUES
(1, 1, 'First point', 1, '2018-07-17 06:12:31'),
(2, 3, 'test', 1, '2018-07-17 06:34:13'),
(3, 1, 'Type a short description to help you identify the restore point. the current date and time are automatically added ', 1, '2018-07-17 08:45:58'),
(4, 1, 'fin d\'un monde', 1, '2018-08-06 18:32:49');

-- --------------------------------------------------------

--
-- Table structure for table `slider`
--

CREATE TABLE `slider` (
  `sid` int(99) NOT NULL,
  `smenu_id` int(99) NOT NULL,
  `scaption_title` varchar(200) DEFAULT NULL,
  `scaption_slogan` varchar(255) DEFAULT NULL,
  `scaption_attach` varchar(150) NOT NULL DEFAULT 'caption.png',
  `scaption_align` varchar(10) NOT NULL DEFAULT 'left',
  `switch` varchar(10) NOT NULL DEFAULT 'on',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider`
--

INSERT INTO `slider` (`sid`, `smenu_id`, `scaption_title`, `scaption_slogan`, `scaption_attach`, `scaption_align`, `switch`, `date`) VALUES
(9, 1, 'Game of Throne caracters', '', 'cSo8rCvPyDMg.jpg', 'center', 'on', '2018-07-15 10:31:50'),
(2, 3, 'Game of the year', 'Congrats Sony. Gof of war 2018 .', 'godofwar.jpg', 'left', 'on', '2018-07-08 02:44:57'),
(8, 1, '', '', 'mf1tG3ugmL5d.jpg', 'left', 'on', '2018-07-14 07:10:25'),
(5, 2, 'The Game of Throne', 'comming soon 2019', '23D5gdRweRtF.jpg', 'left', 'on', '2018-07-12 08:05:34'),
(6, 1, 'Season 8', 'throne', '8p8fa6SlE8ou.jpg', 'center', 'on', '2018-07-14 03:47:32'),
(7, 1, 'will she win the war ?', 'give your feedback', 'MCRTNSvMdLxc.jpg', 'left', 'on', '2018-07-14 03:50:41');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` int(99) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category_id` int(99) NOT NULL,
  `switch_subcategory` enum('on','off') NOT NULL DEFAULT 'on',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `title`, `category_id`, `switch_subcategory`, `date`) VALUES
(1, 'Trailer', 2, 'on', '2018-07-05 07:00:48'),
(2, 'Action', 3, 'on', '2018-07-05 08:11:48'),
(3, 'News', 1, 'on', '2018-07-05 08:11:48'),
(4, 'Marvel', 2, 'on', '2018-07-05 08:20:15'),
(5, 'Dcs', 3, 'on', '2018-07-05 08:20:15'),
(6, 'Marvel', 4, 'on', '2018-07-05 08:27:34'),
(7, 'Dcs', 7, 'on', '2018-07-05 08:27:34'),
(11, 'sub category test', 15, 'on', '2018-07-24 17:24:24'),
(10, 'trailer movies', 1, 'on', '2018-07-17 10:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(99) NOT NULL,
  `name` varchar(120) DEFAULT NULL,
  `menu_id` int(99) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `xid` int(99) NOT NULL,
  `xusername` varchar(255) NOT NULL,
  `xpassword` varchar(255) NOT NULL,
  `xfirst_name` varchar(100) NOT NULL,
  `xlast_name` varchar(100) NOT NULL,
  `xemai` varchar(150) NOT NULL,
  `level` enum('visitor','contributor','author','editor','designer','manager','administrator','god root') NOT NULL DEFAULT 'visitor' COMMENT 'Role of users in the system',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` enum('1','0') DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`xid`, `xusername`, `xpassword`, `xfirst_name`, `xlast_name`, `xemai`, `level`, `created_at`, `active`) VALUES
(1, 'demo', '$2y$10$K5giHvr.edDrKWBuOiUgmexmClwTlT4oWLzTtXZ97LAnOEu3tmKn2', 'demonstrate', 'chada', 'demonstrate@ymail.com', 'administrator', '2018-06-11 13:23:21', '1'),
(3, 'visitor', '$2y$10$y0W/SfU63RayQAam42GtGO.17K9DsT3/IEGw1SMq4FKqmdVCeafZ6', 'visitor', 'agent', 'visitor@gmail.com', 'visitor', '2018-08-03 16:34:28', '1'),
(4, 'contributor', '$2y$10$YxWR83vlo0S9y6YNcn4MjO4aF/fG5Br6AQqEepI3pBGamKP9GhyDK', 'contributor', 'agent', 'contributor@gmail.com', 'contributor', '2018-08-03 16:35:07', '0'),
(5, 'author', '$2y$10$V5pUy.Y7BAMNgJf76m594.Azszna/p0Cavy3fUlxT9SeSECcuRF2i', 'author', 'agent', 'author@gmail.com', 'author', '2018-08-03 16:35:37', '0'),
(6, 'editor', '$2y$10$dg3pStdSThh5tulbvjw9qOiGrPN1NOQRJwCEl0tnYFESMrIV3gKhC', 'editor', 'agent', 'editor@gmail.com', 'designer', '2018-08-03 16:36:29', '1'),
(7, 'designer', '$2y$10$WaPDS7j7vCyDVR73qSwFLuOW3qI.Pah9eRJis4g7lKtr5hq4CEHpO', 'designer', 'agent', 'designer@gmail.com', 'god root', '2018-08-03 16:37:18', '1'),
(8, 'manager', '$2y$10$vjyqPmBiOqpcO38LTmWgbeghwaDbwMCQr22JP/iHPWQO92FEEyb9u', 'manager', 'agent', 'manager@gmail.com', 'designer', '2018-08-03 16:38:01', '1'),
(9, 'administrator', '$2y$10$HeUZ4zH1..lgGq9Uanz3lev2v79i3NKjyzQB3lgifyRapeH7CUT92', 'louis', 'agent', 'administrator@gmail.com', 'administrator', '2018-08-03 16:38:43', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `sub_category_id` (`sub_category_id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `backofficeconfig`
--
ALTER TABLE `backofficeconfig`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `display`
--
ALTER TABLE `display`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `globalpoint`
--
ALTER TABLE `globalpoint`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menusetting`
--
ALTER TABLE `menusetting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `point`
--
ALTER TABLE `point`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `slider`
--
ALTER TABLE `slider`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `smenu_id` (`smenu_id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_id` (`menu_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`xid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `backofficeconfig`
--
ALTER TABLE `backofficeconfig`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `display`
--
ALTER TABLE `display`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `globalpoint`
--
ALTER TABLE `globalpoint`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `menusetting`
--
ALTER TABLE `menusetting`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `point`
--
ALTER TABLE `point`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `slider`
--
ALTER TABLE `slider`
  MODIFY `sid` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(99) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `xid` int(99) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
