# Backend test - questions stats calculation

Greeting fellow backend developer, the [Bloom at Work](https://www.bloom-at-work.com)'s team has a mission for you!

## The mission

Over the years, we have collected a lot of insightful data regarding well-being at work. For each question we asked, we gathered
float values (from `0.` to `10.0` included) as responses. Thanks to this, we would like now to be able to extract statistics
on these questions.   


### What we expect from you

We have collected these responses into CSV files. These files contain only one column that is the said value. From this we
expect you to be able to compute simple metrics such as:
- the **minimum value**
- the **maximum value**
- the **mean value**, e.g. the average given by all the respondents

For this, we have bootstrapped for you a Symfony 4.2 console project, with a _ready-to-be-implemented_ command named `BloomAtWork\Command\QuestionStatsCommand`. 
From there you'll have to extract these values and compute them into an implementation of the abstract class `BloomAtWork\Model\AbstractQuestion`.

To get started, all you have to do is run `composer` and you'll be ready to start developing:

```bash
composer install
```

As a bonus, if you're able to write tests ensuring the service works as expected, we'd be really grateful.

**Good luck!** 
