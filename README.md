# Statamic Image Upload Bug
## How to reproduce
1. Clone this repo
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Fill in the `AWS_ACCESS_KEY_ID`, `AWS_SECRET_ACCESS_KEY`, `AWS_BUCKET`, `AWS_URL` and `AWS_REGION`
5. Open `php artisan tinker`
6. Output the content of the test article by running `Statamic\Facades\Entry::find('581b43b1-1ad9-47ea-b613-76187aba71d0')->toAugmentedArray()['content']->value()`
7. The output should look something like this:
```
<p>This is a test entry with images from AWS.</p>
```
8. **Don't** exit `php artisan tinker` and open the test article in the control panel (Login: `test@test.com`, Password: `testtesttest`)
9. In the control panel add an image to the test article in the `Content` field
10. Upload a new image
11. Click the `Save & Publish` button
12. Switch back to your terminal and run `Statamic\Facades\Entry::find('581b43b1-1ad9-47ea-b613-76187aba71d0')->toAugmentedArray()['content']->value()` again
13. The output should include the new image (with the correct path)
14. Keep `php artisan tinker` open and repeat steps 9-12 (make sure to upload a new image again!)
15. **Now the output will include an image with an empty path** (`<img src="" alt="">`)
