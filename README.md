# Tic-Tac-Toe AI

PHP AI for a tic-tac-toe game.

## Installation
## How To Use

`Player` and `Board` are main classes of this package. You create a board, give it to a AI player and receive a board with his move. `placeMark` is a main function for player.

```php
use AirPetr\TicTacToeAi\Player;
use AirPetr\TicTacToeAi\Board;

$board = new Board();
$player = new Player();

echo $board->toString(); // "_________"

$boardWithMove = $player->placeMark('X', $board);

echo $boardWithMove->toString(); // "__X______"
```

There are three difficulties of AI players: easy, normal and hard.
- Easy player does random moves. 
- Hard player is based on a minimax algorithm. He is unbeatable.
- Normal player is a combination of both. He doesn't give you an easy victory, but can be caught by fork. Just like an average human Tic-tac-toe player.

```php
$easyPlayer = Player::easy();
$normalPlayer = Player::normal();
$hardPlayer = Player::hard();
```

Board can be created from various data sources. Use `X` and `O` symbols for board initialization:

```php
$board1 = Board::createByString('__X___O__');
echo $board1->toString(); // "__X___O__"

$board2 = Board::createByPlainArray(['_', '_', 'X', '_', '_', '_', 'O', '_', '_']);
echo $board2->toString(); // "__X___O__"

$board3 = Board::createByArrayTable([
    ['_', '_', 'X'],
    ['_', '_', '_'],
    ['O', '_', '_']
]);
echo $board3->toString(); // "__X___O__"
```

Board also can be converted to various representations:

```php
$board = Board::createByString('__X___O__');

$board->toString();
// "__X___O__"

$board->toPlainArray();
// ['_', '_', 'X', '_', '_', '_', 'O', '_', '_']

$board->toArrayTable();
// [['_', '_', 'X'], ['_', '_', '_'], ['O', '_', '_']]
```

## Demo

You can play with code in `demo` folder. Here's how you can run interactive game:

```bash
php demo/interactive_game.php
```

## Testting

There are some unit tests in `test` folder. Run tests by:

``` bash
composer test
```
