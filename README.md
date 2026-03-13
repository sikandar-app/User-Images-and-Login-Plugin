# User Images and Login Plugin

## Project Overview

**User Images and Login** is a WordPress plugin that provides a custom private page template with integrated user authentication and photobooth image gallery management. This plugin allows authenticated users to view their personal photobooth images organized by categories (crown, hairline, left, right, top).

### Key Features
- Custom page template system compatible with WordPress 4.6 and above
- Secure user login/authentication
- Private user-only content pages
- Photobooth image gallery management
- Image organization by angle/category
- Responsive Bootstrap UI
- Remember me functionality for user credentials
- Session management

---

## Installation

### Prerequisites
- WordPress 4.6 or higher
- PHP support for file system operations
- Write permissions to WordPress uploads directory

### Steps

1. **Download the Plugin**
   - Clone or download this repository to your local machine

2. **Upload to WordPress**
   - Connect via FTP or use WordPress file manager
   - Navigate to `/wp-content/plugins/`
   - Upload the entire `user-images-and-login` folder

3. **Activate the Plugin**
   - Go to WordPress Admin Dashboard
   - Navigate to **Plugins**
   - Find **User Images and Login**
   - Click **Activate**

4. **Create a Private Page**
   - Go to **Pages → Add New**
   - Assign the **Private Page Template** from the page template dropdown
   - Configure your page settings
   - Publish the page

5. **Verify Installation**
   - The private page should now use the custom template
   - Users can log in through the login form
   - Authenticated users will see their photobooth images

---

## Backend Architecture

### Plugin Structure

```
user-images-and-login/
├── user-images-and-login.php          # Main plugin file
└── template/
    ├── private-page-template.php      # Custom page template
    └── assets/
        └── css/
            ├── bootstrap.min.css      # Bootstrap framework
            └── style.css              # Custom styling
```

### Core Components

#### 1. **Main Plugin File** (`user-images-and-login.php`)
- **PageTemplater Class**: Manages custom page template registration
- **Key Functions**:
  - `get_instance()`: Singleton pattern for plugin instance
  - `add_new_template()`: Registers template with WordPress 4.7+
  - `register_project_templates()`: Adds template to WordPress cache
  - `view_project_template()`: Routes pages to custom template

#### 2. **Private Page Template** (`template/private-page-template.php`)
- **User Authentication**:
  - Login form with email and password fields
  - Remember me checkbox functionality
  - Session and cookie management
  - WordPress `wp_signon()` for secure authentication

- **Image Gallery Management**:
  - Retrieves user images from `/wp-content/uploads/photobooth/{user_id}/{category}/`
  - Supported categories: crown, hairline, left, right, top
  - Uses `glob()` to fetch image files
  - Responsive grid layout using Bootstrap (col-2 columns)

#### 3. **Styling** (`template/assets/css/`)
- **bootstrap.min.css**: Responsive framework
- **style.css**: Custom color and layout styles

### Backend Workflow

1. **Plugin Initialization**
   - Hooks into `plugins_loaded` action
   - Registers template with WordPress
   - Caches template metadata

2. **Page Request**
   - Checks if page uses custom template
   - Loads `private-page-template.php`
   - Verifies user login status

3. **User Login Process**
   - Receives POST request with email and password
   - Authenticates via `wp_signon()` function
   - Handles error messages
   - Creates session and optional cookie

4. **Image Retrieval**
   - Gets active user ID from session
   - Scans photobooth directory structure
   - Organizes images by category
   - Renders images in responsive grid

### Database & File Structure

**Image Storage Pattern**:
```
/wp-content/uploads/photobooth/
└── {user_id}/
    ├── crown/
    │   ├── image1.jpg
    │   └── image2.jpg
    ├── hairline/
    ├── left/
    ├── right/
    └── top/
```

### Security Features
- WordPress user authentication via `wp_signon()`
- Server-side session management
- File existence validation before rendering
- Error suppression for failed login attempts

---

## Usage

### For Site Administrators
1. Create a new page and select "Private Page Template"
2. Configure page title and settings
3. Publish the page
4. Share the page URL with authorized users

### For End Users
1. Navigate to the private page
2. Enter WordPress user email and password
3. Optionally check "Remember Me" to store credentials
4. View personal photobooth images organized by category

---

## File Permissions

Ensure the following directories have write permissions:
- `/wp-content/uploads/photobooth/` - For image storage

---

## Troubleshooting

| Issue | Solution |
|-------|----------|
| Template not appearing | Ensure WordPress version is 4.6+ |
| Images not displaying | Verify photobooth folder structure and image uploads |
| Login not working | Check WordPress user database and credentials |
| CSS not loading | Verify plugin is properly activated |

---

## Support & Contributions

For issues, feature requests, or contributions, please contact the developer.

**Author**: Sikandar Abbas  
**Version**: 1.0.0  

---

## Future Enhancements

Potential improvements for future versions:
- Admin dashboard for image management
- Image upload functionality
- Multiple photo angle combinations
- Email notifications
- Analytics and reporting
- Advanced user permissions
