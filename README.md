<p align="center">
  <a href="https://zawdam.dev/">
    <img alt="zawdam.dev" src="https://zawdam.dev/logo.svg?ver=1.0" height="100">
  </a>
</p>

<h1 align="center" style="margin-top:0;padding-top:0;display:block;">wp-boilerplate</h1>

<p align="center">
  <img src="https://img.shields.io/badge/dynamic/json.svg?url=https://raw.githubusercontent.com/roots/bedrock/master/composer.json&label=bedrock&logo=roots&logoColor=white&query=$.require[%22roots/wordpress%22]&colorB=2b3072&colorA=525ddc&style=flat-square">
  <img src="https://img.shields.io/badge/docker-29.1.1-informational?logo=docker&style=flat-square&logoColor=ffffff&color=1c71d8&labelColor=1a5fb4">
  <img src="https://img.shields.io/badge/traefik-3.6.4-informational?logo=traefik-proxy&style=flat-square&logoColor=ffffff&color=813d9c&labelColor=613583">
</p>

<p align="center">Bedrock + Dockerfile + Traefik for local reverse proxy and https.</p>

---

# Introduction
A lightweight local [WordPress](https://wordpress.com/) development setup based on [Roots Bedrock](https://roots.io/bedrock/), fully containerized with [Docker](https://www.docker.com/) and secured via [Traefik](https://doc.traefik.io/traefik/). It provides local HTTPS using mkcert, a shared reverse-proxy network, and a predictable environment for modern WordPress development.

---

## Requirements

- Docker
- Docker Compose
- Traefik
  - mkcert
  - Docker shared `proxy` network

---

## Getting Started

- For Traefik container configuration steps [click here](https://github.com/zawadzki/traefik)
- Rename `.env.example` to `.env` and fill it with correct data
- From Project root directory run `docker compose -p example up -d`
- Add in `/etc/hosts` new position `127.0.0.1 example.local.dev`
- At this point WP should be up and running at `https://example.local.dev`

----

## Nice to have
In Project root directory:

```bash
docker compose run --rm node npm install
docker compose run --rm node yarn build
```

Connect database to **PhpStorm**:
- Database → New → Data source → MariaDB
- Host `127.0.0.1`
- User `DB_USER`
- Password `DB_PASSWORD`
- Database `DB_NAME`
- Port must be equal to `DB_PORT`

---

## Known issues
Some browsers might dislike `.local.dev` domain.

### Firefox
If DNS-over-HTTPS is enabled it can bypass `/etc/hosts`

Workaround: `Settings → Network Settings → Enable DNS over HTTPS → set to Off`
