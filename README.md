# Statamic Image Upload Bug
## How to reproduce
1. Clone this repo
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Fill in the `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET`, `AWS_URL` and `AWS_REGION`
5. **Make sure the s3 root folder includes > 3000 files**
6. Set up Redis and fill in the `REDIS_HOST`, `REDIS_PASSWORD` and `REDIS_PORT`
7. Clear cache `php artisan cache:clear`
8. Run the worker `php artisan queue:work --tries=1`
9. Open http://image-bug-example.test/cp/collections/articles/entries/581b43b1-1ad9-47ea-b613-76187aba71d0
10. Upload an image to the `image` field and an image to the `another_image` field
11. Click the `Save & Publish` button
12. The worker will process `App\Listeners\DoSomethingWithEntry` **and will run into a timeout**
