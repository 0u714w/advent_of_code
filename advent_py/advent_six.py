def count_guard_positions(map):
    rows = len(map)
    cols = len(map[0])
    visited = set()
    directions = {'^': (-1, 0), '>': (0, 1), 'v': (1, 0), '<': (0, -1)}
    dir_order = {'^': '>', '>': 'v', 'v': '<', '<': '^'}

    x = y = dir = None
    for i in range(rows):
        for j in range(cols):
            if map[i][j] in '^>v<':
                y, x, dir = i, j, map[i][j]
                break
        if dir is not None:
            break

    while True:
        visited.add((y, x))

        next_y = y + directions[dir][0]
        next_x = x + directions[dir][1]

        if next_y < 0 or next_y >= rows or next_x < 0 or next_x >= cols:
            break

        if map[next_y][next_x] == '#':
            dir = dir_order[dir]
        else:
            y, x = next_y, next_x

    return len(visited)

def find_loop_positions(map):
    rows = len(map)
    cols = len(map[0])
    directions = {'^': (-1, 0), '>': (0, 1), 'v': (1, 0), '<': (0, -1)}
    dir_order = {'^': '>', '>': 'v', 'v': '<', '<': '^'}
    loop_positions = set()

    x = y = dir = None
    for i in range(rows):
        for j in range(cols):
            if map[i][j] in '^>v<':
                y, x, dir = i, j, map[i][j]
                break
        if dir is not None:
            break

    for i in range(rows):
        for j in range(cols):
            if map[i][j] == '.':
                temp_map = [list(row) for row in map]
                temp_map[i][j] = '#'
                if causes_loop(temp_map, y, x, dir, directions, dir_order):
                    loop_positions.add((i, j))

    return loop_positions

def causes_loop(map, start_y, start_x, start_dir, directions, dir_order):
    rows = len(map)
    cols = len(map[0])
    visited = set()
    y, x, dir = start_y, start_x, start_dir

    while True:
        if (y, x, dir) in visited:
            return True
        visited.add((y, x, dir))

        next_y = y + directions[dir][0]
        next_x = x + directions[dir][1]

        if next_y < 0 or next_y >= rows or next_x < 0 or next_x >= cols:
            return False

        if map[next_y][next_x] == '#':
            dir = dir_order[dir]
        else:
            y, x = next_y, next_x

    return False

with open('input.txt') as f:
    map = [line.strip() for line in f]

result = count_guard_positions(map)
print(f"The guard visited {result} distinct positions.")

loop_positions = find_loop_positions(map)
print(f"There are {len(loop_positions)} positions where a new obstruction would cause the guard to get stuck in a loop.")
