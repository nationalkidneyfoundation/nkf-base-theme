# Drupal theme for kidney.org
This is the theme that runs the show.

## css development
### Getting started
```
cd dev
npm install
gulp
```
### sass directory structure
- base
  This directory includes files for global resets.
- classes
  Includes single
- components
- theme
- utilities

### Naming Convention

For `classes` use full property name plus value separated by `--` e.g.:
- .float--right { float: right; }
- .font-style--normal  { font-style: normal; }

For `utilities` and `theme` declarations use same convention but ...
