## concrete5 WorldSkills package

A concrete5 add-on/package that includes the WorldSkills theme for Member websites. Version 5.7 of concrete5 or newer is required.

### Installation with Composer

The recommended way to install both concrete5 and this package is to use a Composer. See [Composer Based Skeleton for concrete5 sites](https://github.com/concrete5/composer) for more information.

```
composer create-project -n concrete5/composer your_project_name
cd your_project_name
composer require worldskills/concrete5-worldskills
```

### Setup

After installation do the following tasks to setup the package inside concrete5"

1. Go to *Extend concrete5* in the concrete5 Dashboard and click *Install* for the WorldSkills add-on.

2. If you want to delete all content of your website and see how the theme can be used check *Yes. Reset site content with the content found in this package*. Never do this on a real website as it deletes all your existing content.

3. Go to the home page and switch to Edit Mode. Click on the block "Learning new skills can change your life" and click "Design & Custom Template". Click on the small cog icon and change "Block Container Class" to "Disable Grid Container". Click on "Save" and publish the page.

### Customization

- Colours can be changed by customizing the Theme in the [Design setting](http://www.concrete5.org/documentation/using-concrete5-7/in-page-editing/the-toolbar/page-edit-drop-down/design/).

### Alternative Installation without Composer (not recommended)

Clone or download this repository and copy all files to `packages/worldskills/` inside your concrete5 installation.

```
cd /path/to/concrete5/
git clone https://github.com/worldskills/concrete5-worldskills.git packages/worldskills/
```
