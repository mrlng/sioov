    <div class="form-group">
        <label for="title">ID</label>
        <p>{{ $items->order_id }}</p>

        <?php if ($item->production == "belum dikerjakan") { ?>
            <form action="{{ route('jobs.update_design', $item->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <input type="text" class="form-control" name="production" value="proses design" hidden>
                <!-- <input type="text" class="form-control" name="production" value="proses design" hidden> -->
                <button type="submit" class="btn btn-sm btn-danger">Update</button>
            </form>
        <?php  } if ($item->production == "proses design") { ?>
            <form action="{{ route('jobs.update_production', $item->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <input type="text" class="form-control" name="production" value="proses produksi" hidden>
                <input type="text" class="form-control" name="vendor_id" value="proses produksi" hidden>
                <button type="submit" class="btn btn-sm btn-danger">Update</button>
            </form>
        <?php  } if ($item->production == "proses produksi") { ?>
            <form action="{{ route('jobs.update', $item->id) }}" method="POST" style="display:inline">
                @csrf
                @method('PUT')
                <input type="text" class="form-control" name="production" value="selesai" hidden>
                <button type="submit" class="btn btn-sm btn-danger">Update</button>
            </form>
        <?php  } ?>    
    </div>
