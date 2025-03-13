#!/bin/bash

tmux new-session -d -s fms -c ~/FMS_Laravel
tmux send-keys -t fms "sail up" C-m
echo "Waiting for Laravel Sail to start up..."
until curl -s http://localhost > /dev/null 2>&1; do
    echo "Waiting for Laravel Sail to be ready..."
    sleep 5
done
echo "Laravel Sail is up and running!"
tmux split-window -h
tmux send-keys "sail bun run dev" C-m
tmux split-window -v
tmux send-keys "sail artisan reverb:start --port=8080" C-m
tmux split-window -v
tmux send-keys "sail artisan queue:work" C-m
tmux attach -t fms


