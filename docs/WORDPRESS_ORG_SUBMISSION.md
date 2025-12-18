# WordPress.org Plugin Directory - Submission Guide

> Checklist and preparation guide for submitting ODR Image Optimizer to the official WordPress Plugin Directory at plugins.wordpress.org

**Status:** Ready for submission  
**Target Release:** Q1 2026

---

## 📋 Pre-Submission Requirements

### ✅ Plugin Requirements Met

- [x] **License:** GPL v2+ (confirmed in LICENSE file)
- [x] **WordPress Compatibility:** WordPress 5.0+ (documented in README)
- [x] **PHP Compatibility:** PHP 7.4+ (documented in README)
- [x] **Tested Up To:** WordPress 6.9 (update before submission)
- [x] **Plugin Stability:** Production-ready (v1.0.0+)

### ✅ Plugin Files & Structure

- [x] **Main Plugin File:** `image-optimizer.php` (with proper header)
- [x] **Plugin Header Comment:** Contains Name, Description, Version, Author, License
- [x] **README.md:** Comprehensive documentation
- [x] **CONTRIBUTING.md:** Contribution guidelines
- [x] **CHANGELOG.md:** Version history
- [x] **LICENSE:** GPL v2+ license file
- [x] **Code Standards:** WordPress Coding Standards compliant

### ✅ Documentation

- [x] **Installation Instructions:** In README.md
- [x] **Usage Guide:** Dashboard, Settings, REST API documented
- [x] **Feature List:** Comprehensive with screenshots
- [x] **FAQ:** Common questions answered
- [x] **Troubleshooting:** Performance tips and common issues
- [x] **Developer Documentation:** docs/DEVELOPMENT.md

---

## 🔄 Pre-Submission Steps

### Step 1: Update Plugin Header (CRITICAL)
Update version numbers and compatibility in `image-optimizer.php`:

```php
<?php
/**
 * Plugin Name: ODR Image Optimizer
 * Plugin URI: https://wordpress.org/plugins/odr-image-optimizer/
 * Description: Professional image compression, WebP conversion, and lazy loading
 * Version: 1.0.0
 * Author: Danh Le
 * Author URI: https://danhle.net
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: odr-image-optimizer
 * Domain Path: /languages
 * Requires at least: 5.0
 * Requires PHP: 7.4
 * Tested up to: 6.9
 * Stable tag: 1.0.0
 * Network: false
 */
```

**Checklist:**
- [ ] Version matches CHANGELOG.md latest
- [ ] Tested up to: WordPress 6.9 (current version)
- [ ] Requires at least: 5.0
- [ ] Requires PHP: 7.4
- [ ] Stable tag: 1.0.0
- [ ] License: GPL v2 or later
- [ ] Domain path: /languages

### Step 2: Verify README.md Format
WordPress.org uses specific README format. Convert `README.md` to WordPress.org style:

Create `readme.txt` in root (WordPress.org requires this):

```
=== ODR Image Optimizer ===
Contributors: odanree
Tags: image-optimization, image-compression, webp, lazy-loading, performance, odr-image-optimizer
Requires at least: 5.0
Tested up to: 6.9
Requires PHP: 7.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Professional image optimization for WordPress with intelligent compression, WebP conversion, and lazy loading.

== Description ==

Image Optimizer is a production-ready WordPress plugin demonstrating enterprise-level development practices...

[Full description from README.md]

== Installation ==

1. Upload the plugin directory to `/wp-content/plugins/`
2. Activate through WordPress Admin Plugins page
3. Navigate to Image Optimizer → Settings
4. Configure compression level and options

== Frequently Asked Questions ==

= Is this production-ready? =

Yes! The plugin follows WordPress best practices and security standards.

[More FAQs from README.md]

== Screenshots ==

1. Admin Dashboard - Real-time optimization statistics
2. Visual Library View - Optimization status per image
3. Settings Page - Compression level configuration

== Changelog ==

= 1.0.0 =
* Initial release
* Image compression (JPEG, PNG, GIF)
* WebP conversion
* Lazy loading
* REST API
* Admin dashboard

== Support ==

For issues and feature requests: https://github.com/odanree/image-optimizer/issues
Professional support: Contact via danhle.net

```

**Checklist:**
- [ ] Create `readme.txt` in root directory
- [ ] Format follows WordPress.org standards (see link below)
- [ ] All tags accurate and descriptive
- [ ] Stable tag matches plugin version
- [ ] Screenshots section references images in `assets/` directory

### Step 3: Prepare Screenshots
WordPress.org plugin directory requires screenshots in specific format:

**Location:** `/assets/` directory (separate from plugin root)

**File naming:** `screenshot-1.png`, `screenshot-2.png`, `screenshot-3.png`

**Recommended Sizes:**
- First screenshot: 1200 x 900 (optimal, shows plugin in action)
- Additional: 1024 x 768 minimum
- Format: PNG, JPG, or GIF
- File size: < 5 MB each

**Required Screenshots:**
- [x] screenshot-1.png - Dashboard showing statistics
- [x] screenshot-2.png - Image library view
- [x] screenshot-3.png - Settings page

**Checklist:**
- [ ] Screenshot files in `/assets/` folder
- [ ] Named: `screenshot-1.png`, `screenshot-2.png`, etc.
- [ ] At least 3 high-quality screenshots
- [ ] Each < 5 MB file size
- [ ] Show plugin's best features

### Step 4: Security & Code Review
Before submission, ensure:

**Checklist:**
- [ ] No admin notices that break with other plugins
- [ ] All user input sanitized (check with `phpcs`)
- [ ] All database queries use prepared statements
- [ ] All output properly escaped
- [ ] No database tables created outside activation
- [ ] No excessive logging/debug code
- [ ] No hardcoded API keys or credentials
- [ ] No external service dependencies required (optional OK)
- [ ] Deactivation cleans up properly (hooks removed)
- [ ] No infinite loops or recursion risks

**Run Code Standards Check:**
```bash
cd /Users/odanree/Documents/Projects/image-optimizer
composer run phpcs
```

**Common Issues WordPress.org Flags:**
- ❌ Using `eval()`, `create_function()`, or `$_FILES` directly
- ❌ Unescaped output: `<?php echo $var; ?>`
- ❌ Unsanitized input: `$_POST['key']` without sanitization
- ❌ Using `add_action` in conditional blocks
- ❌ Global variables in plugin scope
- ❌ Calling jQuery without dependencies

### Step 5: Create SVN Account & Plugin Slug
1. Create WordPress.org account: https://login.wordpress.org/register
2. Request plugin slot: https://wordpress.org/plugins/developers/add/
   - **Plugin Name:** Image Optimizer
   - **Plugin Slug:** `image-optimizer` (must be unique)
   - **Short Description:** Professional image compression, WebP conversion, and lazy loading
   - **Plugin Type:** Free plugin
   - **Accept Terms:** Agree to plugin guidelines

**Expected Response Time:** 24-48 hours

### Step 6: Set Up SVN Access
Once plugin slug approved, configure SVN:

```bash
# Install SVN
brew install subversion

# Configure SVN credentials
svn co https://plugins.svn.wordpress.org/image-optimizer/ ~/svn-image-optimizer

# Add files to SVN trunk
cd ~/svn-image-optimizer/trunk
cp -r /Users/odanree/Documents/Projects/image-optimizer/* .

# Add readme.txt to trunk
cp /Users/odanree/Documents/Projects/image-optimizer/readme.txt .

# Add screenshots
mkdir assets
cp /Users/odanree/Documents/Projects/image-optimizer/assets/screenshot-*.png assets/

# Add files for commit
svn add trunk/*
svn add trunk/assets/*

# Commit to WordPress.org
svn ci -m "Initial release v1.0.0"
```

---

## 🚀 Submission Workflow

### Option A: Direct SVN Submission (Recommended)

1. **Prepare plugin files** (follow steps above)
2. **Create readme.txt** in root
3. **Upload to SVN:**
   ```bash
   svn co https://plugins.svn.wordpress.org/image-optimizer/ ~/svn-img-opt
   cd ~/svn-img-opt/trunk
   
   # Copy all plugin files
   cp -r /Users/odanree/Documents/Projects/image-optimizer/* .
   
   # Add & commit
   svn add --force .
   svn ci -m "Release version 1.0.0"
   ```

4. **Create SVN tag:**
   ```bash
   svn cp trunk tags/1.0.0
   svn ci -m "Tag version 1.0.0"
   ```

5. **WordPress.org processes automatically** (within 24 hours)

### Option B: WordPress.org Upload Form

1. Create account at plugins.wordpress.org
2. Submit plugin details via form
3. WordPress.org team reviews (48-72 hours)
4. Plugin approved or requested changes
5. Upload via SVN once approved

---

## 📋 WordPress.org Plugin Guidelines

**CRITICAL Policies:**

### ✅ Allowed
- GPL v2+ compatible licensing
- Optional premium features (with free tier functional)
- Calls to your own APIs (documented)
- Database tables for functionality
- Admin pages and options
- REST API endpoints
- Custom post types/taxonomies
- Scheduled events (wp-cron)

### ❌ Not Allowed
- Linking to commercial services without clear disclosure
- Drive users to upgrade without working free tier
- Obfuscated code
- Malware or security vulnerabilities
- Deceptive functionality
- Tracking user data without consent
- Automatic updates outside WordPress.org
- Licensing checks that break plugin
- Ads in admin (without clear disclosure)
- Performance-degrading code

**Full Guidelines:** https://developer.wordpress.org/plugins/wordpress-org/detailed-guidelines/

---

## 🔍 Pre-Launch Quality Checklist

- [ ] Plugin name unique and available
- [ ] readme.txt formatted correctly
- [ ] 3+ high-quality screenshots prepared
- [ ] All phpcs standards pass (`composer run phpcs`)
- [ ] No PHP warnings/notices on fresh install
- [ ] Tested on WordPress 5.0 and 6.9
- [ ] Tested on PHP 7.4 and 8.3
- [ ] Deactivation & reactivation works cleanly
- [ ] No database errors in debug log
- [ ] Settings page works without errors
- [ ] Dashboard displays without JavaScript errors
- [ ] REST API endpoints respond correctly
- [ ] Inline documentation complete (PHPDoc)
- [ ] CHANGELOG.md up to date
- [ ] AUTHORS/CONTRIBUTORS documented
- [ ] Translation strings wrapped in `__()`, `_e()`, etc.
- [ ] License header in all files

---

## 📦 Version Release Checklist

**Before Each Release:**

1. **Update Version Numbers:**
   ```bash
   # In image-optimizer.php
   - Version: 1.0.0
   - Stable tag in header
   
   # In package.json
   - "version": "1.0.0"
   
   # In CHANGELOG.md
   - Add new version with date and changes
   ```

2. **Update readme.txt:**
   - Tested up to: Latest WordPress version
   - Changelog section

3. **Git Commit:**
   ```bash
   git tag -a v1.0.0 -m "Release version 1.0.0"
   git push origin main
   git push origin v1.0.0
   ```

4. **SVN Commit:**
   ```bash
   svn cp trunk tags/1.0.0
   svn ci -m "Release version 1.0.0"
   ```

5. **Create GitHub Release:**
   - Go to https://github.com/odanree/image-optimizer/releases
   - Create new release from tag v1.0.0
   - Add release notes from CHANGELOG.md

---

## 🆘 Common Rejection Reasons

**Plugin Rejected? Check:**

| Reason | Solution |
|--------|----------|
| **Coding standards** | Run `phpcs --standard=WordPress` and fix issues |
| **Incomplete readme.txt** | Ensure proper formatting with all sections |
| **Missing screenshots** | Add 3+ screenshots in `/assets/screenshot-*.png` |
| **Security issues** | Audit all input sanitization and output escaping |
| **Performance** | Check for inefficient queries or loops |
| **Unescaped output** | Find `echo $var` and replace with `echo esc_html($var)` |
| **Unsanitized input** | Find `$_POST/$_GET` and sanitize with `sanitize_*` |
| **Poor documentation** | Expand README with usage examples |
| **No deactivation cleanup** | Add `register_deactivation_hook()` |

**Resubmit After Fixes:**
- Address all feedback
- Update CHANGELOG.md
- Commit changes
- Resubmit via same process

---

## 📚 Resources

- **Plugin Guidelines:** https://developer.wordpress.org/plugins/wordpress-org/
- **Detailed Guidelines:** https://developer.wordpress.org/plugins/wordpress-org/detailed-guidelines/
- **readme.txt Format:** https://wordpress.org/plugins/readme.txt
- **SVN Repository:** https://plugins.svn.wordpress.org/
- **Plugin Developer Blog:** https://make.wordpress.org/plugins/
- **Security Best Practices:** https://developer.wordpress.org/plugins/security/

---

## 🎯 Success Criteria

Upon approval:
- ✅ Plugin listed on plugins.wordpress.org
- ✅ Search results show Image Optimizer
- ✅ 1-click install from WordPress admin
- ✅ Automatic updates when new versions released
- ✅ User reviews visible
- ✅ Support forum available
- ✅ GitHub integration with plugin files

---

## 📞 Support After Launch

**User Communication Channels:**
- WordPress.org plugin page support forum
- GitHub issues for bug reports
- danhle.net contact form for inquiries

**Maintenance:**
- Monitor support forum for issues
- Fix security vulnerabilities immediately
- Test compatibility with new WordPress versions
- Update "Tested up to" quarterly
- Publish updates for major WordPress releases

---

**Ready to Submit?** Follow the checklist above step-by-step. Good luck! 🚀

Maintained by: [@odanree](https://github.com/odanree)
