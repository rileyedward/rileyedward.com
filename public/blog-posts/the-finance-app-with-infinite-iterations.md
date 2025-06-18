As I was getting deeper into college, living on my own, my finances naturally began to get more and more complicated. Keeping track of bills and their due dates, more variable costs month by month, freeing up space for any potential savings. I tried various mobile apps, spreadsheet templates, and gotcha web applications, but nothing I reached for seem to fit the use-case for what I was looking for in a budgeting app.

## The Initial Problem

Over time I naturally gravitated towards Notion to keep track of all my monthly bills and the minimal finance reports that I do month by month. Overall it was just a nice resource to use to store all of the information I needed to know in formats that were easy to visualize. The issue that I saw start to rise was more of the day by day insights into my finances.

With the challenges of keeping track of all those monthly expenses as well as how much you have spent through various credit card accounts you may have, I often worried about how much *actual* money I had at any given point with what I've *actually* spent.

### My First Attempt

In an effort to keep track of how much money I had at any given time with the various credit accounts I had, I made a super simple budgeting application with Next and JavaScript. It was as simple as signing up with an email and password using Next Auth and setting an initial balance for how much you had at that given point. You could then make transactions to "spend" or "deposit" money into that balance. A glorified counter application...

While it's **incredibly** simple, it was quite early on in college and was my first real attempt at using more in-depth techniques - like interacting with a PostgreSQL database with Prisma, or authentication users with JWT using Next Auth. I even deployed the application through Vercel and was actively using it personally for a few months before moving on to further iterations.

## Welcome to Corvesive

As I continued to use my daily budgeting application I realized that there was the potential to expand the scope of this project into something more. I kept trying to find an existing solution out there that fit the exact use-case I was looking for in an all-purpose finance application, but in-turn decided to build my own - **Corvesive**.

> The name doesn't mean anything at all... I honestly just randomly came up with it and it worked.

### v1 - Discovering Inertia.js

While building the first iteration of **Corvesive** I was inspired by the recently discovered library **Inertia.js** that's used in the Laravel ecosystem to work with modern frontend JavaScript frameworks like React or Vue. I was gearing up to work with the library on an upcoming project at my job during that time, so I took this opportunity to build out a project I was excited about while learning some new tech at the same time.

This version added the simple ability to keep track and manage each of your monthly expenses and keep track of how that affects your day-to-day balance on-hand. You'd start with an initial balance and make transactions throughout the month when you make payments on your bills or just day-to-day purchases. It then simply just showed you a simple badge on the home screen of what your current balance on-hand was at that time.

While I was excited to work with the new tech of the Inertia library, this version of the project was quite simple and used the very bare bone features of the Laravel and Vue frameworks.

### v2 - Separation of Concerns

During a time at work when the work was slowing down a bit in tandem with a staycation I had with some PTO, I took that time to rethink and develop another iteration of **Corvesive**. I know... taking PTO from my job to work on a software side project. I already had the time off booked on my calendar, it was mostly just a matter of then deciding what to do at that point - and I saw an exciting chance to work on this cool project.

At that point in my development career, I kept thinking over the idea of what my version of a full-stack application would look like with all of **MY** best practices. What would a project of mine look like if I really took the time to decide all the technology used, the pattern and structural decisions, all those details that usually go into a project with a full team.

I decided to write a full API with Laravel and PHP with a client side application made with Nuxt and Vue. At that time I really liked the idea of having total control of the code that interacted with the server and the code that interacted with the client in separate, controlled environments. While I look back now in regret in those decisions as I have more recently preferred keeping things more monolothic when you can, I was very happy with the results I was able to provide - including a fully complete CI/CD pipeline that would build and deploy the application to both Vercel for the Nuxt application, and Forge for the Laravel API.

### v3 - Back to the Monolith

More and more time went on and I quickly came to the conclusion that managing two separate codebases for a project that I was the sole user of was a bit much. In classic developer fashion I decided to take the longest possible road and completely rebuild the project using Laravel with the trusted and mighty Inertia.js. I found the most success and am most proud of this version of the project.

I used all the core features that Laravel provides out of the box, making the backend piece of development much smoother. With libraries like TailwindCSS and the advantages of the new Vue composition API I was also able to build a pretty comprehensive frontend codebase as well. The project was deployed through Laravel Forge through an automatic CI/CD pipeline using GitHub actions, and was monitored through services like **Telescope** and **Pulse**.

Both version two and version three of **Corvesive** included much more comprehensive features from a product standpoint. Including:

- The ability to track your monthly expenses and savings throughout different months of the year, so you have historical data throughout the year.
- Make transactions and deposits to your total balance to have better insights into your day-to-day balance on-hand.
- View reports on what you're spending and where you're spending it in a given timeframe.

## What's Next?

What I've come to realize while writing this is that this project will forever be that one project that I'll forever haunt me as a developer. I'm no longer using any version of the project and don't have any plans in the near future to revamp development on it, but I don't see that being the case forever.

### Experimenting with SvelteKit

There was a brief period some time ago when I was transitioning to a new job that utilized SvelteKit with TypeScript in their tech stack - something I've never worked with in the past. In efforts to better understand the ins and outs of the framework I was going to be using soon I started working on a new iteration of **Corvesive** that utilized some of the same tools.

- **Svelte 5 Runes** for state management and reactivity within the application.
- **Prisma ORM** for interacting with the database to make SQL queries and handle database migrations.
- **Docker/Docker Compose** for building environments for a SSR application and PostgreSQL database.

### Conclusion

Needless to say, I think there will always be a part of me that will want to iterate upon this project with different technologies with minor changes and improvements each time. It feels like the perfect project that requires a ton of features that span the full scale of modern web development and serves as a good test for how well I’m able to work within a certain framework. Corvesive has become more than just an app for tracking finances—it’s a platform where I continue to refine and apply my skills, experimenting with new tools, patterns, and technologies. The more I iterate on it, the more I discover new ways to optimize and enhance the user experience, even when the immediate need for an update isn’t pressing.

In a way, Corvesive represents my growth as a developer. Each version of the app has reflected where I was in my learning journey, and as my skills evolve, so does the app. I can look back and see how each decision—from database choices to frontend frameworks—mirrored the challenges I was facing at the time. But it’s not just about technical growth. The project also forces me to think about what users really need from a budgeting app and how to balance functionality with simplicity. And because I’ll always be looking for ways to improve, I don’t think this project will ever be “finished.” The iterative nature of development, especially on personal projects, means that there’s always room for one more feature or one more refinement, which makes Corvesive the perfect kind of ongoing endeavor for me.

As I continue to explore other technologies and grow in my career, I know I’ll look back at Corvesive and feel the pull to continue iterating on it. Even when I’m not actively working on the app, the idea of refining it will always be in the back of my mind. It’s a perpetual project, one that grows with me, and that’s exactly what makes it so exciting to work on—there’s always a new direction to take it, always something to improve, and always the opportunity to challenge myself with something new. Whether it’s with SvelteKit, a new database, or even a shift in the way I think about user experience, Corvesive will forever be a project that keeps me engaged and motivated to push my skills further.
