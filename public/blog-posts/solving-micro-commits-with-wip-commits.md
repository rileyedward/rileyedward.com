As a developer, I used to bloat my Git repositories with an excessive number of micro-commits. Change the name of a function and update all its references? Commit. Remove unused imports from a single file? Commit. Add a quick to-do comment for what’s next? You guessed it —commit.

While micro-committing has its merits—like adding clarity to Git history, simplifying rollbacks, and easing debugging—I mostly did it because of how my brain works. For me, it’s easier to make small, incremental changes as I think through a problem than to batch everything into one large commit. And if something goes wrong, I often rely on git reset --hard to quickly revert to a clean (or work-in-progress) state.

In fact, I use this so often that I’ve aliased it in my terminal to make it faster—and a bit more satisfying:

```bash
alias nope='git reset --hard'
```

## The Downside of Micro-Commits

But micro-committing has its issues. It clutters your commit history with messages like “Changed variable name to X” or “Added to-do comments for Y.” For some developers and teams, this is fine, but for me, it created a messy, noisy history that was hard to navigate.

Let’s consider an example. Suppose you’re building a feature that involves creating an API endpoint and using it to display data on the UI. You might break it down into the following steps:

1. Create new API endpoint
    1. Define the new API route and the corresponding code logic that runs for the endpoint
    2. Write a function that makes a call to the database for some example data as a response
2. Display data from API endpoint onto UI
    1. Write a function that calls the new API endpoint and parses the response data
    2. Call this new function on page load and assign to reactive variable
    3. Display returned reactive variable onto the UI

Now, depending on your approach, your commit history could look drastically different.

- **Minimalist:** One commit for the API endpoint and another for the UI changes.
- **Intermediate:** A commit for each step (e.g., defining the route, querying the database, etc.).
- **Overzealous (my old style):** A commit for every tiny change, even for tasks like renaming a variable or fixing a typo.

While the latter approach might feel productive in the moment, I found myself constantly frustrated later when searching for specific changes. Instead of focusing on meaningful milestones—like solving a user story or addressing a business requirement—my commit messages were a disorganized mess.

## My Solution: gip

To balance the benefits of micro-commits with cleaner Git histories, I created **gip**—a lightweight CLI tool that makes managing work-in-progress commits effortless.

Using **gip** is as simple as running:

```shell
gip
```

This command commits your current changes with the message “WIP.” After you’ve made several WIP commits, you can squash them into a single, meaningful commit:

```shell
gip -m "[COMMIT MESSAGE]"
```

The tool looks for recent commits with the message “WIP” and merges them into one commit with the message you provide. This keeps your workflow flexible during development while maintaining a clean and readable history.

## How it Works

**gip** is written in Go, leveraging the standard library in a single file. While I don’t claim to be a Go expert, the language’s simplicity made it perfect for crafting a straightforward CLI tool.

Here’s how it works:

1. If the -m flag is present, **gip** squashes WIP commits. Otherwise, it simply runs git commit -m "WIP".
2. For squashing, the tool:
    1. Iterates through your commit history, collecting messages until it finds one that isn’t “WIP.”
    2. Rebases the WIP commits into a single commit using git reset --soft HEAD~[NUMBER].

This simple logic has saved me countless hours of manual Git cleanup and helped me maintain both productivity and clarity.

## Was It Worth it?

Could I switch to a robust Git client to manage all this more efficiently?

Probably...

Will I stubbornly stick to the command line and continue building my own tools to optimize my workflow?

Probably.

**gip** embodies the intersection of problem-solving and tinkering that I love about being a developer. It’s not just a tool—it’s a small victory in my ongoing quest to make development workflows as seamless as possible.
