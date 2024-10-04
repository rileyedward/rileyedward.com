# rileyedward.com

My personal website.

## Getting Started

### Prerequisites

Ensure you have the following prerequisites installed on your system. You can verify each installation by running the provided commands in your terminal.

1. **Docker** is used for containerization. Confirm Docker is installed by running:

   ```bash
   docker --version
   ```

2. **Node** and **NPM** (Node Package Manager) are needed for managing frontend dependencies. Check their installations with:

   ```bash
   node --version
   npm --version
   ```

### Installation

1. Duplicate the example environment file and configure it with your settings:

   ```bash
   cp .env.example .env
   ```

2. Install JavaScript dependencies:

   ```bash
   npm install
   ```

3. Build the PostgreSQL database and run migrations:

   ```bash
   npm run db:build
   npm run db:migrate
   ```

4. Compile assets and run the Svelte application:

   ```bash
   npm run dev
   ```
