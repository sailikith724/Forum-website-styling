CREATE TABLE `posts` (
 `id` int(11) NOT NULL,
 `username` varchar(50) NOT NULL,
 `topic_title` varchar(150) NOT NULL,
 `message` text NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp()
)
INSERT INTO `posts` (`id`, `username`, `topic_title`, `message`, `created_at`) VALUES
(1, 'karthikeswaran19', 'k jiy8b', 'j 9', '2026-06-11 11:49:38');
 
