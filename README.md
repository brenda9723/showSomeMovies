# 🎬 MovieApp CLI
Project idea found in https://roadmap.sh/projects/tmdb-cli
https://github.com/brenda9723/showSomeMovies

An interactive command-line interface (CLI) application built with **PHP** that consumes **The Movie Database (TMDB)** API. It allows you to quickly check the latest movies, popular titles, top-rated films, and upcoming releases directly from your terminal.


## ✨ Features

- **Interactive Navigation:** Simple menu system using text commands.
- **Security:** Environment variable configuration (`.env`) to protect your API credentials.
- **Efficient Fetching:** Uses `cURL` for fast REST API requests to TMDB.
- **Clean Output:** Organized display of movie titles and release dates with emojis.

## 🛠️ Requirements

- **PHP 8.0** or higher.
- **cURL** extension enabled in your PHP configuration.
- An active [TMDB](https://www.themoviedb.org/) account to generate an API Read Access Token.

## 🚀 Installation & Setup

1. **Clone or download this repository.**
2. **Configure your credentials:**
   Create a file named `.env` in the root directory and add your token as follows:

   ```env
   TMDB_TOKEN=your_long_access_token_here
