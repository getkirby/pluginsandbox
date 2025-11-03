# Kirby Plugin Sandbox

This is our test environment for third-party plugins. We isolate every plugin into their own installation and have ready-made setups for each plugin, which you can switch in the Panel.

## Installation

After cloning the repo, the submodules need to be initialized.

```
git submodule update --init --recursive
```

## How to install a demo setup for a new plugin

1. Add a new folder for the plugin to `/plugins`. It's suggested to use the plugin name as folder name.
2. Add sample content and a site folder
3. Install the plugin as submodule if possible

Example submodule installation

```
git submodule add https://github.com/getkirby/kql.git plugins/kql/site/plugins/kql
```

### Install via CLI command

```
kirby sandbox:create:plugin "Plugin name"
```

This will create the basic content and site folders. You still need to install the submodule afterwards.

## Panel login

Email: admin@getkirby.com
Password: 12345678

## How to switch plugin test setups

1. Go to the Panel
2. Click on `Plugins` in the sidebar and choose the plugin you want to test
3. Due to a Panel issue, you need to reload afterwards to load all plugin components
