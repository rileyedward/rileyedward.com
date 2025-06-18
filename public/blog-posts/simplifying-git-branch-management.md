When working on projects with multiple developers, your branching strategy plays a critical role in keeping everything organized. Whether it’s something straightforward like each developer working in their own branch or a more structured approach using feature and release branches, your strategy directly impacts collaboration.

But let’s be honest... branch names can get pretty gnarly. Consider a branch like feature/profile-update-api-endpoint. Now imagine adding issue numbers to the mix, resulting in something like `feature/profile-update-api-endpoint-12345`. It doesn’t take long for your Git workflow to feel unwieldy.

Over the years, many developers have recommended GUI-based Git clients like Kraken, Git Tower, or even VS Code extensions to make managing branches easier. Yet no matter how compelling their arguments, I’ve always gravitated toward the command line for most, if not all, Git operations. There’s something deeply satisfying about typing out commands, which, for me, beats the convenience of a GUI every time.

## The Problem

Typing everything out is great—until it’s not. The complexity of branch names can make even basic operations like checking out a branch a chore.

In projects where we've included issue numbers in branch names, I often found myself doing the following:

1. Running `git branch` to view the full branch name
2. Copying or carefully typing out `git checkout feature/...`

This two-step process didn't just apply to checking out branches - it became equally tedious when rebasing, merging, or deleting branches. It was repetitive, time-consuming, and honestly, a bit of a buzzkill.

## My Solution: rbranch

Rather than giving in to GUI clients, I chose to tackle the problem head-on by creating my own custom CLI tool: **rbranch**.

**rbranch** is a streamlined CLI tool built with Go and Bubbletea, specifically designed to simplify the often tedious Git branching workflow. If you’re tired of typing out lengthy and cumbersome branch names, **rbranch** has you covered. With just a few intuitive commands, you can handle common Git branch operations effortlessly.

Here's what **rbranch** can do:

1. **Checkout branches**: Simply run the `rbranch` command to view a list of available branches. From there, select the branch you want to switch to—no need to memorize or type long branch names.
2. **Copy branch names**: Use the `rbranch -c` command to select a branch from the list and copy its name to your clipboard. This makes it easy to share branch names or paste them where needed without error.
3. **Deleting branches**: Keep your local repository tidy by using the `rbranch -d` command. Select a branch from the list, and **rbranch** will delete it for you—no risky typing required.

Each of these features offers a simple, efficient way to manage your Git branches, allowing you to perform operations effortlessly by selecting from a list using just your keyboard.

## Basic Flow of Code

Here's a simplified look at how **rbranch** works:

1. **Parse Flags**: The program reads command-line flags (-c, -d, or none) to determine the desired action: copy, delete, or check out a branch.
2. **Fetch Branches**: It runs git branch to get a list of available branches and formats them for selection.
3. **Display Branches**: Using Bubbletea, the branches are displayed as an interactive list in the terminal.
4. **Handle User Input**: Users can navigate the list with arrow keys and select a branch with Enter or quit with Ctrl+C.
5. **Execute Command**: Based on the user’s selection and the input flag, the program will either copy the branch name, delete that branch, or checkout the branch.
6. **Provide Feedback**: After executing the command, the program confirms the action or reports errors, ensuring clear communication with the user.

## Using Bubbletea

### Why Bubbletea?

Working with long lists of branches could quickly become cumbersome without a well-designed UI. Instead of implementing my own handling for interactive lists and input, Bubble Tea provided the tools to build a smooth and intuitive experience out of the box. Its built-in support for interactive elements like lists, combined with its composable architecture, made it the perfect choice for **rbranch**.

### How rbranch Uses Bubbletea

Bubble Tea simplifies building terminal-based applications by dividing them into three parts:

1. **Model**: The model stores the state of the application, such as the list of branches, the currently selected branch, and any flags (e.g., whether the program is copying or deleting branches).
2. **Update**: The update function handles user input (like key presses) and updates the application’s state accordingly. For example, when an arrow key is pressed, the selection moves up or down the list of branches.
3. **View**: The view function renders the terminal UI. This is where the branch list, highlighting, and any messages to the user (e.g., “Branch deleted successfully”) are displayed.

## Conclusion

Building **rbranch** with Go and Bubble Tea was a rewarding experience. By tackling the tedious aspects of working with Git branches, **rbranch** has streamlined my workflow and made repetitive tasks a breeze. Bubble Tea played an essential role in shaping the interactive and polished CLI experience that **rbranch** delivers.

If you’re a developer who spends a lot of time in the terminal and loves the command line as much as I do, I encourage you to try out Bubble Tea in your next project. And, of course, give **rbranch** a spin—because managing branches doesn’t have to be a chore.
