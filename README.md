# WordPress Full Stack Developer 


### WordPress plugin based on https://wppb.me/ that will do the following
- Create a custom post type as _**Products**_
- Create an archive template xd.adobe
  - Title (Default Post Title)
  - SKU (Custom Text Field)
  - Rating (Custom Number Field)
  - Document (File Field) - This will save the file in the WordPress media library {restrict to PDF type only}
  - Price (Custom Text Field)
  - Image (Featured Image)
  - Video (Custom Text Field) {This will be used to fill in a YouTube video URL}
  - Details (Default Content Field)
- Post Type (Products) will have the following custom taxonomies:
  - Category
  - Seller
  
### Working order
Please work on tasks in the following order:
1. As soon as plugin is activated, it should auto populate demo data (at least 5 dummy records).
2. Archive template for Products Post type 
3. Show detail data under list item when click on plus icon 
4. Clicking on featured image will auto play YouTube video in a popup.
5. Although this is written as the last item in the working order but it should be done first. Create theme options within this plugin where you will add two fields. Both would be text fields. Field one will be Read Time and Field two will be Estimated Time. In Read Time you will write the time in minutes it took you to read and understand all these requirements and in the other field you will write the estimated time it will take to do all this work in minutes as well and all this information should be populated in theme options as soon as the plugin is activated.

### Notes
- You should create a Gulp task to combine and minify all of plugin’s JavaScript and CSS files. Enqueue the minified public version of assets to WordPress plugin.
- Use SASS to write your CSS not direct CSS.
- You can't use Advanced Custom Fields plugin for this assignment or similar plugins.

