<a href="/create">
    <button type="button"  style="appearance: none; outline: none; border: none; text-align: center; min-width: 100px; border-radius: 10px; background-color: black; color: white; padding: 10px; font-size: 12px;
    line-height: 16px; margin-bottom: 20px;">Create URL</button></a>
<div style="display: flex; flex-direction: column; gap: 10px;">
    <?php if (!empty($urls)): ?>
        <table style="border-collapse: collapse; width: 100%; max-width: 500px;">
            <thead>
            <tr>
                <th style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px;">ID</th>
                <th style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px;">Key</th>
                <th style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px;">URL</th>
                <th style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px;">Clicks</th>
                <th style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px;">Expires at</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($urls as $url): ?>
                <tr>
                    <td style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px; text-align: center;"><?= htmlspecialchars($url->id) ?></td>
                    <td style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px; text-align: center;">
                        <a href="/redirect/<?= htmlspecialchars($url->code)?>" target="_blank" ><?= htmlspecialchars($url->code) ?></a>
                    </td>
                    <td style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px; text-align: center;">
                        <a href="<?= htmlspecialchars($url->url) ?>" target="_blank"><?= htmlspecialchars($url->url) ?></a>
                    </td>
                    <td style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px; text-align: center;"><?= htmlspecialchars($url->clicks) ?></td>
                    <td style="font-size: 14px; line-height: 18px; border: 1px solid #ccc; padding: 8px; text-align: center;"><?= htmlspecialchars($url->expires_at) ?></td>

                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div>No URLs created yet</div>
    <?php endif; ?>
</div>

