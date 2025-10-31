# UI Library Issue Report

## Problem Description
The UI library examples are crashing with exit code 3221226525 (0xC0000409) when trying to run the main loop. This error typically indicates a stack buffer overflow or a similar memory access violation.

## Investigation Summary
1. Basic libui initialization works correctly
2. Creating windows and controls (buttons, etc.) works correctly
3. Running the main loop (`App::main()`) crashes the application
4. The issue affects both Area components and other UI components
5. The issue occurs with both the high-level UI wrapper and the low-level kingbes/libui library

## Root Cause Analysis
The issue appears to be with the underlying libui library or with how it's being used on Windows. The exit code 3221226525 is a Windows exception code for a stack buffer overflow, which suggests that there's a memory access issue in the FFI calls.

## Workarounds
1. Use UI components without running the main loop (for testing purposes only)
2. Consider using a different GUI library that is more stable on Windows
3. Run the application on a different operating system (Linux or macOS) where the library might work correctly

## Recommendations
1. Report the issue to the kingbes/libui repository
2. Consider updating the libui.dll file to a newer version if available
3. Check if there are any known issues with the current version of the library on Windows